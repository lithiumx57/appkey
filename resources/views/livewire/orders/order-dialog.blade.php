<div>
  @if($order instanceof \App\Models\Order)
    <div class="div-cover  addMessageCover {{$class}}" style="z-index: {{$zIndex + 9999}}" wire:click.self="closeMessage()">

      <div class="form-dialog-body" style="width: 1600px;height: 1200px">
        @include("admin.ui.loader")
        <div class="form-dialog-header"> جزئیات سفارش ( {{$order->id}} )
          <span class="x-close"></span>
        </div>
        <div class="form-container">

          <div>

            <div class="d-x-row">
              نام :
              {{$order->name}}
            </div>

            <div class="d-x-row">
              موبایل :
              {{$order->mobile}}
            </div>


            <div class="d-x-row">
              وضعیت :
              <span wire:click="showOrderStatusDialog({{$order->id}})" class="btn btn-sm order-status status-{{$order->status}}">
                {{$order->translateStatus()}}
              </span>
            </div>


            <div class="d-x-row">
              تاریخ ثبت :
              <span onclick="show">
                <span style="cursor: pointer;border-bottom: 1px dashed #eee;" onclick="showSwal('{{convertToJalali($order->created_at,"H:i:s :: Y/m/d ")}}')">
                  {{getAgoJalali($order->created_at)}}
                </span>
              </span>
            </div>

            <div class="d-x-row">
              تاریخ پرداخت :
              <span onclick="show">
                <span style="cursor: pointer;border-bottom: 1px dashed #eee;" onclick="showSwal('{{convertToJalali($order->payed_at,"H:i:s :: Y/m/d ")}}')">
                  {{getAgoJalali($order->payed_at)??"وارد نشده"}}
                </span>
              </span>
            </div>


            <div class="d-x-row">
              تاریخ انجام :
              <span onclick="show">
                <span style="cursor: pointer;border-bottom: 1px dashed #eee;" onclick="showSwal('{{convertToJalali($order->confirmed_at,"H:i:s :: Y/m/d ")}}')">
                  {{getAgoJalali($order->confirmed_at)??"وارد نشده"}}
                </span>
              </span>
            </div>


            <div class="d-x-row">
              کد تخفیف :
              <span onclick="show">
                {{$order->getCouponText()}}
              </span>
            </div>

            <div class="d-x-row">
              مبلغ فاکتور :
              <span onclick="show">
                {{number_format($order->getAmount())}} تومان
              </span>
            </div>


            <div class="d-x-row">
              کانال :
              <span onclick="show">
                {{$order->channel??"وارد نشده"}}
              </span>
            </div>

            <div class="d-x-row">
              <div class="btn-group btn-group-sm">
                <span class="btn btn-sm btn-success" wire:click="showMessageDialog()">پیام ها</span>
                {{--                <span class="btn btn-sm btn-warning">پیام ها</span>--}}
                {{--                <span class="btn btn-sm btn-danger">پیام ها</span>--}}
                {{--                <span class="btn btn-sm btn-info">پیام ها</span>--}}
              </div>
            </div>


          </div>

          <div class="lines mt-2">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th>ردیف</th>
                  <th>عنوان محصول</th>
                  <th>تصویر</th>
                  <th>قیمت</th>
                  <th>صفت ها</th>


                </tr>
                </thead>
                <tbody>

                @foreach($order->lines as $line)
                  <tr>
                    <td>{{$line->id}}</td>
                    <td>{{$line->name}}</td>
                    <td>
                      <img style="border-radius: 8px" width="100px" src="{{$line->getImage()}}" alt="">
                    </td>
                    <td>
                      {{number_format($line->price_data["price"])}} تومان
                    </td>

                    <td>
                      <table class="table table-bordered">
                        @foreach($line->price_data["extractedAttributes"] as $key => $value)
                          <tr>
                            <th>{{$key}}</th>
                            <td>{{$value}}</td>
                          </tr>
                        @endforeach
                      </table>
                    </td>
                  </tr>

                @endforeach
                </tbody>

              </table>
            </div>

          </div>

        </div>


      </div>


    </div>
  @endif


</div>
