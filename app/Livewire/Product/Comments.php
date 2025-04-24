<?php

namespace App\Livewire\Product;

use App\Infrastructure\Blog\CommentCacheGenerate;
use Livewire\Component;

class Comments extends Component
{
  public string $model;
  public int $modelId;

  public string $text = "";
  public $parent = 0;


  public function addAnswer($id): void
  {
    $this->parent = $id;
  }

  public function render()
  {
    $comments = CommentCacheGenerate::generate($this->model, $this->modelId);
    return view('livewire.product.comments', compact("comments"));
  }


}
