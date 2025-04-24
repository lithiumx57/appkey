<div class="cart-container">
  @if($quantity>0)
    <div class="main-part box mt-4" style="position: relative;background: var(--box-background)">
      <div style="padding: 8px;width: 100%">
        <table class="table table-bordered" style="text-align: right">
          <thead>
          <tr>
            <th style="text-align: right">محصول</th>
            <th style="text-align: right">تعداد</th>
            <th style="text-align: right">قیمت</th>
          </tr>
          </thead>
          @foreach($lines as $line)


            <tr style="padding: 16px">
              <td>
                <h3 style="margin-top: 0;margin-bottom: 8px">{{$line->cache["title"]}}</h3>

                <div>


                  @foreach($line->cache["attributes"] as $attribute=>$value)
                    <div>
                      {{$attribute}} :{{$value}}
                    </div>
                  @endforeach
                </div>
              </td>

              <td>
                <div style="width: 100px;text-align: center;height: 100%;align-items: center;display: flex">
                  <span wire:click="plus({{$line->id}})" style="display: inline-block;height: 32px;width: 32px;text-align: center;line-height: 32px;cursor: pointer">+</span>
                  <span style="display: inline-block;height: 32px;width: 32px;text-align: center;line-height: 32px">{{$line->qty}}</span>
                  <span wire:click="minus({{$line->id}})" style="display: inline-block;height: 32px;width: 32px;text-align: center;line-height: 32px;cursor: pointer">-</span>
                </div>
              </td>
              <td>
                <x-toman :text="$line->getPriceText()"/>
              </td>


            </tr>
          @endforeach
        </table>
      </div>
    </div>

    <div class="aside-part box mt-4" style="position: relative;background: var(--box-background)">
      <div style="width: 100%;padding: 4px 12px">
        @if($cart)
          <div style="display: flex;justify-content: space-between;align-items: center;padding: 8px">
            <span>تعداد محصولات :</span>
            <span style="font-weight: bold;font-size: 14px;color: var(--full-color)">
              {{$quantity}}
            </span>
          </div>



          <div style="border-top: 1px solid var(--border-color);display: flex;justify-content: space-between;align-items: center;padding: 8px">
            مبلغ کل :
            <x-toman text="{{number_format($cart->getPrice())}}"/>
          </div>

          <div style="border-top: 1px solid var(--border-color);;display: flex;justify-content: space-between;align-items: center;padding: 8px;justify-content: center">

            <button class="x-button-2 p-2 mt-2" wire:click="next">
              <span class="text">مرحله بعد</span>
            </button>

          </div>

        @endif

      </div>
    </div>
  @else
    <div class="box mt-4 tac" style="position: relative;background: var(--box-background);width: 100%;line-height: 100px;margin: auto">
      سبد خرید خالی است
    </div>
  @endif

</div>
