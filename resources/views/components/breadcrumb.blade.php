<section class="x-container mt-3 {{$clazz}}">
  <nav class="breadcrumb">
    <x-font-icons.location-icon width="22" height="22" clazz="breadcrumb-location mobile-hidden desktop-show"/>

    <ul class="">
      @foreach($records as $key=> $record)
          <?php
          $isLatest = count($records) == $key + 1;
          ?>
        <li>
          @if(!$isLatest)
            <a href="{{$record["link"]}}">{{$record["title"]}}</a>
            <span>❯</span>
          @else
            <span class="main">{{$record["title"]}}</span>
          @endif
        </li>
      @endforeach
    </ul>
  </nav>
</section>
