<?php

namespace App\Helpers\Html;


use Symfony\Component\DomCrawler\Crawler;

class ExtractClasses
{
  public static function findTagsWithClass($html, $className)
  {
    $crawler = new Crawler($html);
    $elements = $crawler->filter(".$className");

    $result = [];
    foreach ($elements as $element) {

      $result[] = [
        'tag' => $element->tagName,
        "value" => $element->nodeValue,
        'class' => $element->getAttribute('class')
      ];
    }

    return $result;
  }
}
