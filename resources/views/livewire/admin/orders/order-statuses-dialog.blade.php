<div>
  <div class="div-cover  addMessageCover {{$class}}" style="z-index: {{$zIndex + 9999}}" wire:click.self="closeDialog()">
    @if($class =="active")

      <div class="form-dialog-body" style="width: 434px;height: 200px">
        @include("admin.ui.loader")
        <div class="form-dialog-header">وضعیت سفارش {{$id}}
          <span class="x-close"></span>
        </div>
        <div class="form-container">
          @foreach(\App\Models\Order::TRANSLATE_STATUSES as $key=> $status)
            <span wire:click="changeStatus('{{$key}}')" class="order-status status-{{$key}} m-1">{{$status}}</span>
          @endforeach
        </div>
      </div>
    @endif

  </div>

</div>
