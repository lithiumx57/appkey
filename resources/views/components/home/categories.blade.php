<section class="product-slider-container position-relative" dir="ltr">
  <div class="p-box-header">
    <span class="box-title p-bg">
      پلتفرم ها :
    </span>
    <a href="/platforms" class="link">
      بیشتر >
    </a>
  </div>
  <div class="box-slider p-bg pt-2 pb-2" dir="rtl">
    <div class="swiper category-slider box-slider">
      <div class="swiper-wrapper">
        @foreach($records as $row)
          <a href="{{$row["link"]}}" class="swiper-slide box  product position-relative">
            {!! buildChachedImage($row["image"]) !!}
            <p>
              {{$row["title"]}}
            </p>
          </a>
        @endforeach
      </div>
    </div>
  </div>
</section>


