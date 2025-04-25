@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/product.css")}}">
  <link rel="stylesheet" href="{{asset("assets/libs/css/swiper.min.css")}}">
@endsection

@section("content")

  <x-breadcrumb :records="$product['breadcrumb']" clazz="p-breadcrumb"/>


{{--  <div style="position: fixed;z-index: -1;width: 100vw;height: 100vh;left: 0;right: 0;top: 0;--}}
{{--background: url(http://static.appkey.local/files/cache/products/2025/03/248_call-of-duty-black-ops-6-game-for-pc.webp) no-repeat;--}}
{{--    background-size: cover;--}}
{{--    background-position: center;--}}
{{--    background-repeat: no-repeat;--}}
{{--    background-attachment: fixed;"></div>--}}
{{--    <div style="position: fixed;z-index: -1;width: 100vw;height: 100vh;left: 0;right: 0;backdrop-filter: blur(50px);top: 0"></div>--}}

    <section class="x-container box product-details ma pb-3 p-4">
    <div class="product-container">
      <div class="image-part">
        {!! buildChachedImage($product["mainImage"]) !!}
        <div class="d-flex justify-content-center mt-2">
          <livewire:product.favorite-icon model="product" :id="$product['id']"/>
          &nbsp;&nbsp;
          &nbsp;&nbsp;
          <livewire:product.share-icon model="product" :id="$product['id']" :link="$product['link']"/>
        </div>
      </div>
      <div class="buttons-part">
        <h1>{{$product["name_fa"]}}</h1>
        <div class="name-en" style="position: relative">
          <span class="n-en">{{$product["name_en"]}}</span>
          <span class="line" style="width: calc(100% - {{ceil(strlen($product["name_en"]) * 6.5)}}px);"></span>
        </div>

        @if(count($product["topAttrributes"]) > 0)
          <ul class="top-attributes">
            @foreach($product["topAttrributes"] as $attribute)
              <li>{{$attribute}}</li>
            @endforeach
          </ul>
        @endif
        <livewire:product.pricing-buttons :product-id="$product['id']"/>
      </div>
    </div>
  </section>

  <livewire:product.cart-list :productId="$product['id']"/>
  @if(count($product["gallery"]) > 0 )
    <x-product.gallery :productId="$product['id']"/>
  @endif

  <section class="x-container mt-4 box cart-list pt-0 p-bg product-details br">
    <div>
      <div class="tabs">
        <div class="tab active" data-tab="description">
          توضیحات
          <span class="p-tab-border"></span>
        </div>
        <div class="tab" data-tab="attributes">
          مشخصات
          <span class="p-tab-border"></span>
        </div>
        <div class="tab" data-tab="comments">
          دیدگاه ها
          <span class="p-tab-border"></span>
        </div>
      </div>
    </div>
    <div class="info-part">
      <div id="tab-description" class="tab-content active">
        <button class="x-button-2 more-data p-2 mt-2 vmpi">
          <span class="text vmpi">ادامه نوشته</span>
        </button>
        <div class="content">
          {!! $product["description"] !!}
        </div>
      </div>
      <div id="tab-attributes" class="tab-content p-3">
        <table class="table attribute-tab-table">
          <tbody>
          @foreach($product["details"] as $key => $value)
            <tr>
              <th>
                <div class="attribute-key">{{$key}}</div>
              </th>
              <td class="bold full-color">
                <div class="attribute-value">{{$value}}</div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div id="tab-comments" class="tab-content">
        <livewire:product.comments model-id="{{$product["id"]}}" model="product"/>
      </div>
      <div id="tab-receive" class="tab-content">
        receive
      </div>
    </div>
  </section>

  <div class="x-container">
    <div class="mt-3">
      <x-product.similar-products :product-id="$product['id']"/>
    </div>
  </div>

@endsection

@section("scripts")

  <script src="{{asset("assets/libs/js/swiper.min.js")}}"></script>
  <script>
    document.querySelectorAll(".tab").forEach(tab => {
      tab.addEventListener("click", function () {
        document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));
        document.querySelectorAll(".tab-content").forEach(t => t.classList.remove("active"));
        this.classList.add("active");
        let tabName = this.getAttribute("data-tab")
        let tab = document.getElementById("tab-" + tabName)
        if (tab) {
          tab.classList.add("active")
        }
      });
    });

    var swiper = new Swiper(".product-gallery-swiper", {
      on: {
        click(swiper, event) {

          const target = event.target.closest('a[wire\\:navigate]');

          if (target) {
            const simulatedClick = new MouseEvent('click', {
              bubbles: true,
              cancelable: true,
              view: window,
            });
            target.dispatchEvent(simulatedClick);
          }
        }
      },
      spaceBetween: 8,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      breakpoints: {
        0: {
          slidesPerView: 1.5,
          spaceBetween: 8,
        },
        440: {
          slidesPerView: 2.5,
          spaceBetween: 8,
        },
        570: {
          slidesPerView: 2.7,
          spaceBetween: 8,
        },

        640: {
          slidesPerView: 3.1,
          spaceBetween: 8,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 8,
        },
        900: {
          slidesPerView: 5,
          spaceBetween: 8,
        },
        1024: {
          slidesPerView: 6,
          spaceBetween: 12,
        },
        1300: {
          slidesPerView: 5.8,
          spaceBetween: 12,
        },
      },

    });


  </script>

@endsection
