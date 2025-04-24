<div class="dropdown option-dropdown" data-delete-route="" id="dropdown-options">
  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
    گزینه ها
    <span class="caret"></span></button>
  <ul class="dropdown-menu">
    @foreach($options as $option)
      <li>
        <a
          data-options="{{json_encode(collect($option)->toArray())}}"
          data-enable-check="@if($option->enableCheck){{1}}@else{{0}}@endif"
          data-type="{{$option->type}}"
          class="dropdown-item @if($option->enableCheck) disabled @endif {{$option->clazz}}"
          @if(!$option->enableCheck )
          href="{{$option->link}}"
          @else
            data-link="{{$option->link}}"
          @endif
        >
          <i class="{{$option->icon}}"></i>
          <span>{{$option->title}}</span>
        </a>
      </li>
    @endforeach
  </ul>
</div>
