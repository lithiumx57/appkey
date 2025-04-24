<div>
  <livewire:profile.back-part href="/profile" emit="/" title="کیف پول" back-title="پروفایل کاربری"/>

  <div class="d-flex" style="height: 40px;align-items: center">
    <div>
      موجودی کیف پول :
    </div>
    &nbsp;
    <x-toman :text="$currency"/>
  </div>

  <div class="mt-5">
    شارژ کردن کیف پول:
    <div class="mt-2 d-flex pb-2">
      <input class="x-input-2 number-format" id="w-amount" type="tel" wire:model="price" style="width: 300px;text-align: center" placeholder="لطفا مبلغ مورد نظر خود را وارد نمایید"/>
      &nbsp;
      &nbsp;

      <button class="x-button-2 p-2" wire:click="confirm">
        <span class="text">تایید و پرداخت</span>
      </button>
    </div>

  </div>


  @if($wallets->count() > 0)
    <div>
      <div class="tac" style="border-top: 1px solid var(--border-color);margin-top: 16px;padding-top: 16px">
        همه تراکنش ها
      </div>
      <ul style="padding: 0;list-style: none">
        @foreach($wallets as $wallet)
          <li class="box mb-2 p-2">
            <span style="color: #000000"></span>
            <div> مبلغ : {{$wallet->amount}}</div>
            <div>زمان تراکنش : {{getAgoJalali($wallet->created_at)}}</div>
            <div>وضعیت :
              <span style="color: {{$wallet->getStatusColor()}}">{{$wallet->getStatus()}}</span>
            </div>
          </li>
        @endforeach
      </ul>
      <div class="x-pagination">
        {!! $wallets->links() !!}
      </div>

    </div>
  @endif


</div>
