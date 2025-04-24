<?php

namespace App\Infrastructure\Blog;

use App\Models\Comment;

class CommentCacheGenerate
{
  public static function generate($model, $modelId):array
  {
    $model = Comment::MODELS[$model];
    $comments = Comment::with("approvedChildren")->where("approved", 1)->where("parent", 0)->where("model", $model)->where("model_id", $modelId)->latest()->paginate(12);
    $result = self::castComments($comments);
    return $result;
  }


  private static function castComments($comments): array
  {
    $result = [];
    foreach ($comments as $comment) {
      $result[] = [
        "id" => $comment->id,
        "avatar" => $comment->getAvatar() ?? "",
        "name" => $comment->name,
        "comment" => $comment->comment,
        "children" => self::castComments($comment->approvedChildren),
        "parent" => $comment->parent,
      ];
    }
    return $result;
  }
}
