<div>
  <div class="card-header">
    سفارشات
  </div>
  @include("admin.ui.loader")

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>شماره سفارش</th>
          <th>نام</th>
          <th>شماره موبایل</th>
          <th>مبلغ سفارش</th>
          <th>وضعیت سفارش</th>
          <th>پیام ها</th>
          <th>کانال</th>
          <th>درگاه</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->mobile}}</td>
            <td>{{number_format($order->price)}}</td>
            <td>
              <span class="order-status status-{{$order->status}}" wire:click="showOrderStatusDialog({{$order->id}})">
                {{$order->translateStatus()}}
              </span>
            </td>
            <td>
              <span wire:click="showMessageDialog({{$order->id}})" style="border-bottom: 1px dashed #eee;cursor: pointer;">
                {{$order->getLatestMessage()}}
              </span>
            </td>
            <td>{{$order->channel}}</td>
            <td>{{$order->getGateway()}}</td>
            <td>
              <span style="cursor: pointer;border-bottom: 1px dashed #eee"  onclick="showSwal('{{convertToJalali($order->created_at)}}')">{{getAgoJalali($order->created_at)}}</span>
            </td>
            <td>
              <i class="fa fa-eye cp" wire:click="showOrder({{$order->id}})"></i>
            </td>

          </tr>
        @endforeach
        </tbody>
      </table>

    </div>


  </div>

  <div class="card-footer">
    <div class="tac">
      {!! $orders->links() !!}
    </div>
  </div>
</div>
