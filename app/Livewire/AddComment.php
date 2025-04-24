<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Product;
use Exception;
use Livewire\Component;

class AddComment extends Component
{
  public $parent = 0;
  public string $name = "";
  public string $username = "";
  public string $description = "";
  public $model = "product";
  public $modelId = -1;
  public string $title = "";


  public function mount()
  {
    if (auth()->check()) {
      $this->name = auth()->user()->name ?? "";
      $this->username = auth()->user()->username;
    }

    if ($this->parent > 0) {
      $comment = Comment::find($this->parent);
      $this->title = "ثبت پاسخ ( " . $comment->name . " )";
    } else {
      $this->title = "افزودن دیدگاه جدید";
    }
  }

  public function render()
  {
    return view('livewire.add-comment');
  }

  public function sendComment(): void
  {
    try {
      validate()->validateString($this->name, "نام", min: 3, max: 50);
      validate()->validateString($this->username, "راه ارتباطی", min: 10, max: 50);
      validate()->validateString($this->description, "متن دیدگاه", min: 6, max: 3000);

      $userId = auth()->check() ? auth()->user()->id : 0;

      Comment::create([
        "model" => Comment::MODELS[$this->model],
        "model_id" => $this->modelId,
        "name" => $this->name,
        "username" => $this->username,
        "comment" => $this->description,
        "user_id" => $userId,
        "parent" => $this->parent,
      ]);
      toast($this, "دیدگاه با موفقیت ثبت شد پس از تایید در سایت نمایش داده می شود", "success");
      $this->description = "";
      $this->dispatch("dismiss-comment");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }

  }

}
