<section class="x-container mt-4 box cart-list pt-0 p-bg product-details br">


  <div class="swiper product-gallery-swiper">
    <div class="swiper-wrapper p-2">

      @foreach($records as $record)
        <div class="gallery-item-container swiper-slide mt-2">
          @if($record["type"]=="video")
            <video src="{{$record["file"]}}" controls></video>
          @else
            {!! buildChachedImage(@$record["file"]) !!}
          @endif
        </div>
      @endforeach


    </div>
    <div class="swiper-pagination"></div>
  </div>

</section>
