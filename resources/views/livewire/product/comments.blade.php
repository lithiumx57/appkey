<div class="ps-3 pe-3">

  @include("layouts.partials.comments")

  <div class="dialog-content" id="comment-answer" wire:ignore.self>
    <div class="dialog-body" wire:ignore.self>
      <livewire:add-comment model="{{$model}}" model-id="{{$modelId}}" parent="{{$parent}}" wire:key="comment-{{$parent}}"/>
    </div>
  </div>

  <div class="mt-5">
    <livewire:add-comment model="{{$model}}" model-id="{{$modelId}}" parent="{{$parent}}"/>
  </div>


</div>
