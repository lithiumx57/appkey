<div>
  <div class="div-cover createMessageDialog {{$class}}" wire:click.self="closeDialog" style="z-index: {{$zIndex + 9999}}">

    @if($record instanceof $model)
      <div class="form-dialog-body" style="width: 400px;height: 270px">
        @include("admin.ui.loader")

        <div class="form-dialog-header"> افزودن پیام</div>
        <div class="form-container">
          <div class="row">
            <div class="form-group" style="width: 100%;margin-top: 0;">
              <label for="description" style="margin-right: 22px;width: 100px">متن پیام
                <i class="x-close"></i>
              </label>
              <textarea id="description" wire:model.defer="message" class="form-control" style="height: 100px;width: calc(100% - 36px);margin: auto;padding: 8px">{{$message}}</textarea>
            </div>


            {{--            <div class="form-group" style="margin-top: 8px">--}}
            {{--              <input aria-label="" type="checkbox" value="on" style="vertical-align: middle" id="isToVendor">--}}
            {{--              <label for="" style="vertical-align: middle">این پیام برای تامین کننده است ( فعلا تستی )</label>--}}
            {{--            </div>--}}


          </div>

          <div class="buttons-container" style="margin-top: 8px !important;">
            <span wire:click="saveMessage" style="font-size: 12px" class="btn btn-success btn-sm confirm-btn">ثبت</span>
            {{--            <span class="cancel-btn cancel-create-price">انصراف</span>--}}
          </div>
          <input type="hidden" id="price_product_id">
        </div>
      </div>
    @endif
  </div>
</div>
