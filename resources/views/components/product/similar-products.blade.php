@if(count($records) > 0)
  <section class="product-slider-container position-relative" dir="rtl">
    <div class="p-box-header">
    <span class="box-title p-bg">
      محصولات مشابه
    </span>

    </div>
    <div class="swiper product-gallery-swiper swiper box-slider p-bg pt-2 pb-2" dir="rtl">
      <div class="swiper-wrapper p-2 box-slider">

        @foreach($records as $row)
          <a href="{{$row["link"]}}" class="swiper-slide box  product s-product position-relative ">
            {!! buildChachedImage($row["image"]) !!}
            <p>
              {{$row["title_fa"]}}
            </p>
          </a>
        @endforeach
      </div>
    </div>
  </section>

@endif
