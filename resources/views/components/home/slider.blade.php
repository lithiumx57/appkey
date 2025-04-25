<carousel-3d-auto>
  @foreach($slides as $slide)
    {!! buildChachedImage($slide["image"]) !!}
    {!! buildChachedImage($slide["image"]) !!}
  @endforeach
</carousel-3d-auto>
