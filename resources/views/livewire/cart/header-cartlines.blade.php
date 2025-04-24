<div>
  <span id="caret-cart"></span>
  <div class="box" id="header-cart-items" style="z-index: 9999;padding: 8px">
    @if($quantity > 0)
      <div style="position: relative">
        {{--        <span style="border-radius: 4px;position: absolute;background: #fff;display: inline-block;width: 33px;height: 33px;left: 0px;top: -2px;transform: rotate(45deg)"></span>--}}

        <div style="position: relative;z-index: 0;">


          @foreach($lines as $line)
            <div style="display: flex;border-bottom: 1px solid var(--border-color);padding-bottom: 8px;padding-top: 8px;position:relative;">
                <span style="background: #ff4444;position: absolute;display: inline-block;width: 20px;height: 20px;border-radius: 100%;color: #fff;text-align: center;top: 0;right: -8px">
                    {{$line->qty}}
                </span>
              <img src="{{@$line->cache["image"]}}" style="width: 42px" alt="">
              <div style="padding-right: 8px;font-size: 12px;line-height: 16px">
                <div style="font-size: 15px">
                  {{$line->cache["title"]}}
                </div>
                <div style="padding-top: 4px">
                  {{implode(",",$line->cache["attributes"])}}
                </div>
              </div>
            </div>
          @endforeach
          <div style="display: flex;justify-content: space-between;align-items: center;height: 64px">
            <div>
              <div>مبلغ قابل پرداخت</div>
              <div style="color: #222;font-weight: bold">
                <x-toman :text="number_format($cart->getPrice())"/>
              </div>
            </div>
            <div>
              <a href="/cart" class="notd header-link">
                <button class="x-button-2 p-2">
                  <span class="text">سبد خرید</span>
                </button>
              </a>
            </div>
          </div>
        </div>

      </div>
    @else
      <div style="height: 100px;text-align: center;line-height: 100px;font-size: 16px">
        سبد خرید خالی است
      </div>
    @endif
  </div>
</div>
