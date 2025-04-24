<picture class="x-image">
  @foreach($paths as $key => $value)
    @if($key=="main")
      <img src="{{$value}}" alt="{{$label}}" class="{{$clazz}}">
    @else
      <source srcset="{{$value}}" type="{{$key}}">
    @endif
  @endforeach
</picture>
