@foreach($comments as $key=> $comment)
  <div class="comment box @if($comment["parent"] > 0 && $key==0) mt-5 @else mt-3 @endif ">
    <div class="name">
      <div>
        <img src="{{$comment["avatar"]}}" alt="{{$comment["name"]}}">
      </div>
      <div style="position: relative;left: 8px;cursor: pointer" class="dialog-button link-mode d-flex" wire:click="addAnswer({{$comment["id"]}})" data-width="400" data-height="400" data-target="comment-answer">
        پاسخ
        <img src="{{asset("files/app/reply.png")}}" alt="" style="width: 20px;position: absolute;left: -24px;top: 6px">
      </div>
    </div>
    <div class="text">
      <pre>{!! buildText(xEscapeHtml($comment["comment"])) !!}</pre>
    </div>
    @include('layouts.partials.comments', ['comments' => $comment["children"]])
  </div>

@endforeach
