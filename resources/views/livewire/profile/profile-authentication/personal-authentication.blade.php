<div class="box">

  @if($isOpened)
    <div style="padding: 12px 8px 24px 8px">
      <label for="">مشخصات هویتی</label>

      <div style="position: relative;top: 8px" wire:key="2">


        <div style="position: relative;top: 8px">
          <div class="d-flex">
            <div class="w-50 me-2">
              <label for="">نام</label>
              <div>
                <input wire:model="name" type="text" class="button-5 w-100 tac mt-2">
              </div>
            </div>
            <div class="w-50">
              <label for="">نام خانوادگی</label>
              <div>
                <input wire:model="family" type="text" class="button-5 w-100 tac mt-2">
              </div>
            </div>
          </div>
        </div>


        <div style="position: relative;top: 24px">
          <div>
            <label for="">کد ملی</label>
            <div>
              <input wire:model="nationCode" type="text" class="button-5 w-100 tac mt-2">
            </div>
          </div>
        </div>

        <div style="position: relative;top: 32px">
          <div>
            <label for="">تاریخ تولد</label>
            <div>
              <input wire:model="birthDate" placeholder="مثال : 1373/11/20" data-jdp-max-date="{{convertToJalali(\Carbon\Carbon::now()->subYears(8)->format("Y/m/d"),"Y/m/d")}}"  type="text" class="button-5 w-100 tac mt-2 date-picker">
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
        مشخصات هویتی
      </div>
      <div>

        @if($authenticated)
          <span wire:click="openAutentication" style="cursor: pointer;border-bottom: 1px dashed var(--border-color)">
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
