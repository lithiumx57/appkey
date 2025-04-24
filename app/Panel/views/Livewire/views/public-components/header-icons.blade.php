<div style="min-width: 200px;display: flex;justify-content: flex-end">


  <div style="position: relative;cursor: pointer">
    <a href="{{buildRoute("/messaging")}}">
      <img src="{{asset("dashboard/images/chat.png")}}" alt="" width="32px">
    </a>
  </div>
  &nbsp;&nbsp;&nbsp;
  &nbsp;
  <div style="position: relative;cursor: pointer" wire:click="showBackgroundDialog()">
    <img src="{{asset("dashboard/images/bg-select.png")}}" alt="" width="32px">
  </div>

  &nbsp;&nbsp;&nbsp;
  &nbsp;
  <div style="position: relative;cursor: pointer" wire:click="showNotificationDialog()">
    <img src="{{asset("dashboard/images/notification.png")}}" alt="" width="32px">
    <span style="position: absolute;background-color: @if($notificationsCount>0) #ff4444 @else #4444ff @endif;display: inline-block;width: 24px;height: 24px;border-radius: 100%;text-align: center;top: -8px;right: -8px">{{$notificationsCount??"0"}}</span>
  </div>
  &nbsp;&nbsp;&nbsp;
  &nbsp;
  <div style="position: relative;cursor: pointer" wire:click="showNotificationDialog()">
    <a href="{{buildRoute("/profile")}}">
      <img src="{{asset("dashboard/images/profile.png")}}" alt="" width="32px">
    </a>
  </div>


  <div style="width:40px ;position: relative;cursor: pointer"></div>


</div>
