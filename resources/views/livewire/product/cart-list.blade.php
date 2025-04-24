<div class="x-container">
  @if(count($records))

  <div class="x-container  cart-list p-4 pb-1" style="display: flex;justify-content: space-between;font-weight: bold">
    <div>
      افزوده شده به سبد خرید
    </div>
    <div>
      <a href="/cart" class="link-mode">برو به سبد خرید</a>
    </div>
  </div>
  <div class="x-container mt-2 box cart-list p-4 p-bg">
      <div class="table-responsive">
        <table class="table table-bordered tac mb-0">
          <tr>
            @foreach($data["attributes"] as $row)
              <th style="text-align: center">{{$row["label"]}}</th>
            @endforeach
            <th style="text-align: center">
              قیمت خرید
            </th>
            <th style="text-align: center">
              عملیات
            </th>
          </tr>
          @foreach($records as $value)
            <tr>
              @foreach($value->data as $k=>$v)
                <td class="cart-td">
                  @foreach($data["attributeValues"][$k] as $a)
                    @if($a["id"]==$v)
                      {{$a["label"]}}
                    @endif
                  @endforeach
                </td>
              @endforeach
              <td>
                <x-toman :text="$value->getPriceText()" clazz="tac justify-content-center normal-price"/>
                <div class="cart-actions-container">
                  <span wire:click="plus({{$value->id}})" class="cart-action">+</span>
                  <span class="cart-value">{{$value->qty}}</span>
                  <span wire:click="remove({{$value->id}})" class="cart-action">-</span>
                </div>
              </td>
              <td>
                <button style="position: relative;top: 8px;padding-right: 16px" wire:click="remove({{$value->id}},{{true}})" class="button-5">حذف</button>
              </td>
            </tr>
          @endforeach

        </table>
      </div>
  </div>
  @endif

</div>
