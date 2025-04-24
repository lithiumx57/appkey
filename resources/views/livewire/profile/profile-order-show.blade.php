<div>
  <livewire:profile.back-part type="both" href="/profile/orders" emit="orders" title="مشاهده سفارش 1" back-title="سفارشات"/>

  @if(!$findOrder)
    <div class="tac">
      سفارش یافت نشد
    </div>
  @else

    <div>
      <ul>
        <li>شماره سفارش : {{$order->id}}</li>
        <li>وضعیت : {{$order->translateStatus()}}</li>
        <li>مبلغ سفارش : {{number_format($order->price)}} تومان</li>
        <li>تاریخ ثبت سفارش : {{$order->created_at}}</li>
      </ul>
      <div class="table-responsive" style="overflow-y: auto">
        <table class="table table-bordered table-responsive tac">
          <tr>
            <th>عنوان محصول</th>
            <th>تصویر</th>
            <th>قیمت</th>
            <th>صفت ها</th>
          </tr>
          @foreach($order->lines as $line)
            <tr>
              <td>{{$line->name}}</td>
              <td><img src="{{$line->getImage()}}" alt="" width="80px"></td>
              <td>{{number_format($line->price)}}</td>
              <td>
                <table class="table table-bordered">
                  @foreach($line->price_data["extractedAttributes"] as $key=>$value)
                    <tr>
                      <th>{{$key}}</th>
                      <td>{{$value}}</td>
                    </tr>
                  @endforeach
                </table>

              </td>
            </tr>
          @endforeach
        </table>
      </div>

    </div>

    <div>
      @foreach($order->lines as  $line)
        <div>

        </div>
      @endforeach
    </div>

  @endif


</div>
