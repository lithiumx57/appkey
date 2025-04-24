<div class="box">

  @if($isOpened)
    <div style="padding: 12px 8px 24px 8px">
      <label for="">اطلاعات مالی</label>

      <div style="position: relative;top: 8px" wire:key="2">


        <div style="position: relative;top: 24px">
          <div>
            <label for="">شماره شبا</label>
            <div>
              <input wire:model="credit" type="text" class="button-5 w-100 tac mt-2">
            </div>
          </div>
        </div>
        <div style="width: 148px;display: block;margin: 64px auto 24px auto">

          <div>
            <span wire:loading class="x-button-1" style="width: 148px">
            <span class="loader-white button-loader" style="left: 12px"></span>
            </span>
          </div>


          <span wire:click="confirm" wire:loading.remove class="x-button-1" style="width: 148px">تایید اطلاعات</span>
        </div>
      </div>

    </div>

  @else
    <div style="display: flex;justify-content: space-between;height: 48px;line-height: 48px;padding: 0 16px">
      <div>
        اطلاعات مالی
      </div>
      <div>

        @if($authenticated && $confirmed)
          <span wire:click="openAutentication" style="cursor: pointer;border-bottom: 1px dashed var(--border-color)">
            احراز هویت شده
          </span>
        @elseif($authenticated && !$confirmed)
          <span wire:click="openAutentication" style="cursor: pointer;border-bottom: 1px dashed var(--border-color)">
            در انتظار تایید
          </span>
        @else
          <span wire:click="openAutentication" style="cursor: pointer;border-bottom: 1px dashed var(--border-color)">
            احراز هویت نشده
          </span>
        @endif

      </div>
    </div>
  @endif
</div>
