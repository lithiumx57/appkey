<div>
  <div class="div-cover  addMessageCover {{$class}}" style="z-index: {{$zIndex + 9999}}" wire:click.self="closeMessage()">
    @if($record instanceof $model)

      <div class="form-dialog-body larger">
        @include("admin.ui.loader")
        <div class="form-dialog-header">پیام های ثبت شده ( {{$modelId}} )
          <span class="x-close"></span>
        </div>
        <div class="form-container">
          <table class="table-bordered table">
            <tr>
              <th>پروفایل</th>
              <th>نویسنده</th>
              <th>پیام</th>

              @if(\App\Models\ModelLog::hasMessageLogMethod($model))
                <th>نوع پیام</th>
              @endif

              <th>زمان ارسال</th>
            </tr>
            @if($records->count() == 0)
              <tr>
                @if(\App\Models\ModelLog::hasMessageLogMethod($model))
                  <td colspan="5" style="text-align: center">هیچ پیامی ذخیره نشده است</td>
                @else
                  <td colspan="4" style="text-align: center">هیچ پیامی ذخیره نشده است</td>
                @endif
              </tr>
            @else

              @foreach($records as $message)
                <tr style="@if($message->mode==8) background:#14566c @else  @endif">
                  <td><img src="{{$message->user->getAvatar()}}" style="width: 40px;height: 40px;border-radius: 100%" alt=""></td>
                  <td>{{$message->user->name}}</td>
                  <td>{{$message->text}}</td>
                  @if(\App\Models\ModelLog::hasMessageLogMethod($model))
                    <td>{{\App\Models\ModelLog::getMessageType($message)}}</td>
                  @endif
                  <td style="cursor: pointer" onclick="showSwal('{{convertToJalali($message->created_at)}}')">{{getAgoJalali($message->created_at)}}</td>
                </tr>
              @endforeach

            @endif

          </table>
        </div>
        <div style="text-align: center">
          <span class="btn btn-warning" wire:click="createNewMessage({{$modelId}})">پیام جدید</span>
        </div>
      </div>
    @endif

  </div>

</div>
