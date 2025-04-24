<?php

namespace App\Helpers;

use App\Models\Product;
use App\Panel\Search\XSearchBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EnhancedSearch
{
  private SearchModel $searchModel;

  public static function with(SearchModel|null $searchModel): EnhancedSearch
  {
    $instance = new EnhancedSearch();
    $instance->searchModel = $searchModel;
    return $instance;
  }

  function generateRegexPattern($text): string
  {
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    return implode(".*", $chars);
  }

  private function getLevel1(): Collection
  {
    return XSearchBuilder::with(Product::class, $this->buildSearchTerm(), ["name_fa", "name_en", "_tags"])->build()
      ->where("approved", true)
      ->select(["id", "name_fa", "name_en", "_tags"])
      ->get();
  }

  private function buildSearchTerm(): string
  {
    $keyword = $this->searchModel->keyword;
    $keyword = convertToEnglishDigit($keyword);
    $keyword = preg_replace('/(\d+)([^\d\s])/', '$1 $2', $keyword);
    $keyword = preg_replace('/([^\d\s])(\d+)/', '$1 $2', $keyword);
    $searchTerm = preg_replace('/(\d)([a-zA-Zء-ي])/', '$1 $2', $keyword);
    return preg_replace('/([a-zA-Zء-ي])(\d)/', '$1 $2', $searchTerm);
  }

  private function getLevel2(): array
  {
    $pattern = $this->generateRegexPattern($this->buildSearchTerm());
    return DB::select("
            SELECT id, name_fa, name_en, _tags
            FROM products
            WHERE approved = 1
            AND (name_fa REGEXP ? OR name_en REGEXP ? OR _tags REGEXP ?)", [$pattern, $pattern, $pattern]);
  }

  private function getLevel3(): array
  {
    $searchTerm = $this->buildSearchTerm();
    $query = "SELECT id, name_fa, name_en, _tags,
                     MATCH(name_fa, name_en, _tags) AGAINST(? IN BOOLEAN MODE) AS relevance,
                     LEVENSHTEIN(name_fa, ?) AS name_fa_similarity_score,
                     LEVENSHTEIN(name_en, ?) AS name_en_similarity_score,
                     LEVENSHTEIN(_tags, ?) AS tags_similarity_score
              FROM products
              WHERE (MATCH(name_fa, name_en, _tags) AGAINST(? IN BOOLEAN MODE)
                     OR name_fa LIKE ?
                     OR name_en LIKE ?
                     OR _tags LIKE ?
                     OR SOUNDEX(name_fa) = SOUNDEX(?)
                     OR SOUNDEX(name_en) = SOUNDEX(?)
                     OR SOUNDEX(_tags) = SOUNDEX(?))
              AND approved = 1
              ORDER BY name_fa_similarity_score ASC, name_en_similarity_score ASC, tags_similarity_score ASC, relevance DESC
              LIMIT 100";
    return DB::select($query, [
      $searchTerm . '*',
      $searchTerm,
      $searchTerm,
      $searchTerm,
      $searchTerm . '*',
      '%' . $searchTerm . '%',
      '%' . $searchTerm . '%',
      '%' . $searchTerm . '%',
      $searchTerm,
      $searchTerm,
      $searchTerm
    ]);
  }

  private function getLevel4(): array
  {
    $searchTerm = $this->buildSearchTerm();
    $query = "SELECT id, name_fa, name_en, _tags
                  FROM products
                  WHERE (MATCH(name_fa, name_en, _tags) AGAINST(? IN NATURAL LANGUAGE MODE)
                  OR name_fa LIKE ? OR name_en LIKE ? OR _tags LIKE ?)
                  AND approved = 1
                  LIMIT 100";
    return DB::select($query, [$searchTerm, '%' . $searchTerm . '%', '%' . $searchTerm . '%', '%' . $searchTerm . '%']);
  }

  private function getLevel5(): array
  {
    $query = "SELECT id, name_fa, name_en, _tags
                  FROM products
                  WHERE MATCH(name_fa, name_en, _tags) AGAINST(? IN NATURAL LANGUAGE MODE)
                  AND approved = 1";
    return DB::select($query, [$this->buildSearchTerm()]);
  }

  private function getLevel6(): array
  {
    $searchTerm = $this->buildSearchTerm();
    $query = "SELECT id, name_fa, name_en, _tags,
                     MATCH(name_fa, name_en, _tags) AGAINST(? IN BOOLEAN MODE) AS relevance,
                     LEVENSHTEIN(name_fa, ?) AS name_fa_similarity_score,
                     LEVENSHTEIN(name_en, ?) AS name_en_similarity_score,
                     LEVENSHTEIN(_tags, ?) AS tags_similarity_score
              FROM products
              WHERE (MATCH(name_fa, name_en, _tags) AGAINST(? IN BOOLEAN MODE)
                     OR name_fa LIKE ?
                     OR name_en LIKE ?
                     OR _tags LIKE ?
                     OR SOUNDEX(name_fa) = SOUNDEX(?)
                     OR SOUNDEX(name_en) = SOUNDEX(?)
                     OR SOUNDEX(_tags) = SOUNDEX(?))
              AND approved = 1
              ORDER BY name_fa_similarity_score ASC, name_en_similarity_score ASC, tags_similarity_score ASC, relevance DESC
              LIMIT 100";
    return DB::select($query, [
      $searchTerm . '*',
      $searchTerm,
      $searchTerm,
      $searchTerm,
      $searchTerm . '*',
      '%' . $searchTerm . '%',
      '%' . $searchTerm . '%',
      '%' . $searchTerm . '%',
      $searchTerm,
      $searchTerm,
      $searchTerm
    ]);
  }

  private function buildHasPrice(array $records): array
  {
    return array_column($records, 'id');
  }

  private function ai($result, $keyword): array
  {
    $records = [];
    $keyword = mb_strtolower($keyword);
    $keyword = convertToEnglishDigit($keyword);

    foreach ($result as $product) {
      $name_fa = strtolower($product->name_fa);
      $name_en = strtolower($product->name_en);
      $tags = strtolower($product->_tags);
      $name_fa = convertToEnglishDigit($name_fa);
      $name_en = convertToEnglishDigit($name_en);
      $tags = convertToEnglishDigit($tags);

      similar_text($name_fa, $keyword, $percent);
      similar_text($name_en, $keyword, $percent);
      similar_text($tags, $keyword, $percent);

      $records[] = [
        "percent" => $percent,
        "product" => $product->name_fa,  // Can display the name_fa, name_en, or tags
        "id" => $product->id
      ];
    }

    $columns = array_column($records, 'percent');
    array_multisort($columns, SORT_DESC, $records);

    return $records;
  }

  public function build(): SearchModel
  {
    $searchTerm = $this->buildSearchTerm();
    $keyword = $this->searchModel->keyword;

    if ($searchTerm != $keyword) {
      $this->searchModel->hasWrongKeyword = true;
      $this->searchModel->validKeyword = $searchTerm;
    }

    $result1 = $this->getLevel1();
    $result2 = $this->getLevel2();
    $result3 = $this->getLevel3();
    $result4 = $this->getLevel4();
    $result5 = $this->getLevel5();
    $result6 = $this->getLevel6();

    $result1 = $this->ai($result1, $searchTerm);
    $result2 = $this->ai($result2, $searchTerm);
    $result3 = $this->ai($result3, $searchTerm);
    $result4 = $this->ai($result4, $searchTerm);
    $result5 = $this->ai($result5, $searchTerm);
    $result6 = $this->ai($result6, $searchTerm);

    $result = [
      ...$result1,
      ...$result2,
      ...$result3,
      ...$result4,
      ...$result5,
      ...$result6,
    ];

    $resultArray = $this->buildHasPrice($result);
    $ids = join(",", $resultArray);

    if (strlen($ids) > 0) {
      $validProducts = Product::whereIn("id", $resultArray)
        ->orderByRaw(compileDbRaw(DB::raw("FIELD(id,$ids)")))
        ->limit($this->searchModel->limit)
        ->get();
    } else {
      $validProducts = collect([]);
    }

    $this->searchModel->products = $validProducts;

    return $this->searchModel;
  }
}
