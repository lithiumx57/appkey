<div class="box">

  @if($isEmailOpened)
    <div style="padding: 12px 8px 24px 8px">

      @if($isSentCode)
        <label for="">کد تایید</label>
        <div style="position: relative;top: 8px" wire:key="1">
          <input wire:model="code" type="text" class="button-5 w-100 tac">
          <div style="width: 120px;display: block;margin: 16px auto">

            <div>
            <span wire:loading class="x-button-1" style="width: 148px">
            <span class="loader-white button-loader" style="left: 12px"></span>
            </span>
            </div>

            <span wire:loading.remove wire:click="confirmCode" class="x-button-1" style="width: 128px">تایید کد</span>
          </div>
        </div>
      @else

        <label for="">ایمیل</label>
        <div style="position: relative;top: 8px" wire:key="2">
          <input wire:model="email" type="text" class="button-5 w-100 tac">

          <div style="width: 148px;display: block;margin: 16px auto">
            <div>
            <span wire:loading class="x-button-1" style="width: 148px">
            <span class="loader-white button-loader" style="left: 12px"></span>
            </span>
            </div>

            <span wire:loading.remove wire:click="sendCode" class="x-button-1" style="width: 148px">ارسال کد تایید</span>
          </div>
        </div>

      @endif

    </div>

  @else
    <div style="display: flex;justify-content: space-between;height: 48px;line-height: 48px;padding: 0 16px">
      <div>
        ایمیل
      </div>
      <div>

        @if($authenticated)
          <span  wire:click="openAutentication" style="cursor: pointer;border-bottom: 1px dashed var(--border-color)">
            احراز هویت شده
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
