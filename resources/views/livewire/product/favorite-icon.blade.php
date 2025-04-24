<div>
  @if($result)
    <div class="fav-button" wire:click="removeFromFavorites" style="position:relative;">

      <div wire:loading.remove>
        <svg style="width: 12px; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="var(--text-color)">
          <path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path>
        </svg>
        <span>
        علاقه مندی
      </span>
      </div>

      <div wire:loading>
        <span class="loader button-loader"></span>
      </div>
    </div>

  @else

    <div class="fav-button"  wire:click="showLoginPopup"  style="position:relative;">
      <div wire:loading.remove>
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="var(--text-color)" style="width: 12px; cursor: pointer;">
          <path d="M336 0h-288C21.49 0 0 21.49 0 48v431.9c0 24.7 26.79 40.08 48.12 27.64L192 423.6l143.9 83.93C357.2 519.1 384 504.6 384 479.9V48C384 21.49 362.5 0 336 0zM336 452L192 368l-144 84V54C48 50.63 50.63 48 53.1 48h276C333.4 48 336 50.63 336 54V452z"></path>
        </svg>
        <span>
        علاقه مندی
      </span>
      </div>

      <div wire:loading>
        <span class="loader button-loader"></span>
      </div>
    </div>

{{--    <div class="fav-button @if(!auth()->check()) dialog-button @endif" @if(auth()->check())  wire:click="addToFavorites" @else  data-target="login-dialog" data-width="380" data-height="420"  @endif>--}}
{{--      <svg  @if(auth()->check())  wire:click="addToFavorites" @else  data-target="login-dialog" data-width="380" data-height="420"   @endif class="@if(!auth()->check()) dialog-button @endif" style="width: 12px; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="var(--text-color)">--}}
{{--        <path  @if(auth()->check())  wire:click="addToFavorites" @else  data-target="login-dialog"  data-width="380" data-height="420"   @endif class="@if(!auth()->check()) dialog-button @endif"  d="M336 0h-288C21.49 0 0 21.49 0 48v431.9c0 24.7 26.79 40.08 48.12 27.64L192 423.6l143.9 83.93C357.2 519.1 384 504.6 384 479.9V48C384 21.49 362.5 0 336 0zM336 452L192 368l-144 84V54C48 50.63 50.63 48 53.1 48h276C333.4 48 336 50.63 336 54V452z"></path>--}}
{{--      </svg>--}}
{{--      <span  @if(auth()->check())  wire:click="addToFavorites" @else  data-target="login-dialog"  data-width="380" data-height="420"   @endif class="@if(!auth()->check()) dialog-button @endif" >--}}
{{--        علاقه مندی--}}
{{--      </span>--}}
{{--    </div>--}}
  @endif
</div>

