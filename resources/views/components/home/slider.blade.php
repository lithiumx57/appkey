{{--<div class="swiper main-slider">--}}
{{--  <div class="swiper-wrapper">--}}
{{--    @foreach($slides as $slide)--}}
{{--      <div class="swiper-slide">--}}
{{--        {!! buildChachedImage($slide["image"]) !!}--}}
{{--      </div>--}}
{{--    @endforeach--}}
{{--  </div>--}}
{{--  <div class="swiper-button-next"></div>--}}
{{--  <div class="swiper-button-prev"></div>--}}
{{--  <div class="slider-swiper-pagination"></div>--}}
{{--</div>--}}


<carousel-3d-auto>
  @foreach($slides as $slide)
      {!! buildChachedImage($slide["image"]) !!}
      {!! buildChachedImage($slide["image"]) !!}
  @endforeach
</carousel-3d-auto>
