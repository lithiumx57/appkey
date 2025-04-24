<div class="ci-container">
  <div class="main">
    <div class="box" style="background: var(--header-backgrround);position: relative;border:1px solid var(--header-backgrround);overflow: hidden;border-radius: var(--border-radius)">
      <div class="box-header">
        اطلاعات شخصی
      </div>
      <div style="padding-top: 42px;width: 100%">
        <div class="w50input right">
          <div><label for="">نام: </label></div>
          <div class="mt-1">
            <input type="text" placeholder="نام و نام خانوادگی شما" class="x-input-2 tac" wire:model="name">
          </div>
        </div>
        <div class="w50input left">
          <div><label for="">ایمیل: </label></div>
          <div class=" mt-1">
            <input placeholder="ایمیل شما" type="text" class="x-input-2 tac" wire:model="email">
          </div>
        </div>
        <div class="p-2  w-100">
          <div class="w-100 left">
            <div><label for="">توضیحات تکمیلی: </label></div>
            <div class=" mt-1 w-100mm4">
              <textarea placeholder="توضیحات اضافی را می توانید اینجا وارد نمایید" type="text" class="x-input-2 w-100" wire:model="description"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box  p-2 mt-3" style="background: var(--header-backgrround);position: relative;border:1px solid  var(--header-backgrround);padding-bottom: 16px">
      <div class="box-header">
        کد تخفیف
      </div>
      <div style="padding-top: 42px;width: 100%">
        <div class="left">
          <div><label style="position: relative;right: 8px" for="">کد: </label></div>
          <div class="mt-1 w-100mm20 ms-2" style="position: relative">
            <input type="text" class="x-input-2 tac" wire:model="coupon">
            <button class="x-button-1  w-100 button-styles" style="position: absolute;left: 6px;top: 6px;max-width: 90px;padding: 8px 0;height: 36px" wire:click="confirmCoupon">
              <span class="text">بررسی کد</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <div class="box p-2" style="background: var(--header-backgrround);position: relative;border:1px solid  var(--header-backgrround);width: 100%">
      <div class="box-header">
        خلاصه سفارش
      </div>
      <div style="padding-top: 42px">
        <ul class="right ps-3">
          @foreach($cart->lines as $line)
            <li>
              {{$line->cache["title"]}}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="box p-2 gateway-box mt-3">
      <div class="box-header">
        انتخاب درگاه
      </div>
      <div style="padding-top: 42px">
        <div class=" right">
          @foreach($gateways as $gateway)
            <div class="gateway-row box mb-2" wire:click="gatewayClicked({{$gateway->id}})">
              <div style="width: 24px;text-align: center;position: relative;top: 4px">
                @if($gateway->id==$selectedGateway->id)
                  <x-font-icons.check width="16" height="16" clazz="fi"/>
                @endif
              </div>
              <img src="{{$gateway->getLogo()}}" alt="" width="32" height="32" style="border-radius: 8px;margin-right: 4px">
              <div style="margin-right: 8px;user-select: none">
                {{$gateway->title}}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <button class="x-button-2 mt-3 w-100" wire:click="confirmAndPay">
      <span class="text">تایید و پرداخت</span>
    </button>
  </div>


  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
</div>
