<div>

  <style>
    .lv-dialog-cover {
      /*background-color: rgba(71,71,71,.3);*/
      backdrop-filter: blur(20px);
      position: fixed;
      left: 0;
      z-index: 1001;
      right: 0;
      top: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
    }

    .lv-dialog {
      position: fixed;
      left: 0;
      right: 0;
      max-width: 90%;
      max-height: 90%;
      top: 0;
      bottom: 0;
      width: 800px;
      height: 600px;
      background: rgba(0, 0, 0, .8);
      border-radius: 8px;
      margin: auto auto;
      overflow: hidden;
      scale: 0.0;
      transition: 200ms;
    }

    .lv-dialog.active {
      scale: 1;
    }


    .lv-header .fa-times {
      display: inline-block;
      width: 42px;
      height: 42px;
      cursor: pointer;
      text-align: center;
      line-height: 42px;
    }

    .lv-header {
      height: 42px;
      line-height: 42px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      padding: 0 16px 0 0;
      background: #222;
    }

    .lv-body {
      height: calc(100% - 42px);
      overflow-y: auto;
      padding: 8px;
    }
  </style>

  @if($show)
    <div class="lv-dialog-cover" wire:click.self="dismiss">
      <div class="lv-dialog">
        <div class="lv-header">
          <span>اعلان ها</span>
          <i class="fa fa-times" wire:click.self="dismiss"></i>
        </div>
        <div class="lv-body">
          <table class="table table-bordered" style="text-align: center">
            <tr>
              <th>ثبت کننده</th>
              <th>پیام</th>
              <th>عملیات</th>
            </tr>
              <?php
              $notifications = \App\Panel\Models\Notification::getNotifications();
              ?>
            @if($notifications->count() > 0)
              @foreach($notifications as $row)
                <tr>
                  <td>{{$row->user->getName()}}</td>
                  <td style="max-width: 400px;text-align: justify;">{!! $row->buildMessage() !!}</td>
                  <td>
{{--                    @if($row->user_id!=user()->getId())--}}
                      @if($row->hasBeenSeen())
                        <span class="btn btn-success" wire:click="seen({{$row->id}})">دیدم</span>
                      @else
                        <span class="btn btn-danger" wire:click="seen({{$row->id}})">دیدم</span>
                      @endif
{{--                    @endif--}}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4" style="text-align: center">اطلاع رسانی ثبت نشده است</td>
              </tr>
            @endif

          </table>

        </div>

      </div>


    </div>



  @endif


</div>
