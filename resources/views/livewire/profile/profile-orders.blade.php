<div>

  <livewire:profile.back-part href="/profile" emit="/" title="سفارشات" back-title="پروفایل کاربری"/>


  <div class="table-responsive">
    <table class="table table-bordered tac">
      <tr>
        <td>شماره سفارش</td>
        <td>تاریخ ثبت</td>
        <td>مبلغ</td>
        <td>وضعیت</td>
        <td>عملیات</td>
      </tr>
      @if($orders->count()==0)
        <tr>
          <td colspan="5">
            <div class="tac">سفارشی ثبت نشده است</div>
          </td>
        </tr>
      @endif
      @foreach($orders as $order)
        <tr>
          <td>{{$order->id}}</td>
          <td>{{convertToJalali($order->created_at,"Y/m/d")}}</td>
          <td>{{number_format($order->price)}}</td>
          <td>{{$order->translateStatus()}}</td>
          <td>
            <a data-change-url="true" class="livewire-mode" data-emit="{{json_encode(["path"=>"orders","p1"=>"show","p2"=>1])}}" data-listener="profile-navigation-changed" href="/profile/orders/show/1">
              <button class="x-button-1" wire:click="sendComment">
                <span class="text">جزئیات سفارش</span>
              </button>
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </div>


</div>
