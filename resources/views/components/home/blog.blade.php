<section class="product-slider-container position-relative">
  <div class="p-box-header">
    <span class="box-title p-bg">
      آخرین مقالات
    </span>
    <a href="/blog" class="lnb">
      بیشتر >
    </a>
  </div>
  <div class="box-slider p-bg pt-2 pb-2">

    <div class="swiper blog-slider">
      <div class="swiper-wrapper">
        @foreach($articles as $row)
          <a href="{{$row["link"]}}" class="swiper-slide box  product position-relative  ">
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


