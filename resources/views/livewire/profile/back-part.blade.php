<div>
  <div class="back-part desktop-show mobile-hidden">
    <div style="display: flex;justify-content: space-between;border-bottom: 1px solid var(--border-color);padding-bottom: 8px;margin-bottom: 8px">
      @if($href!="/profile")
        <a href="{{$href}}" data-change-url="true" class="livewire-mode" data-emit="{{$emit}}" data-listener="profile-navigation-changed" style="display: flex;align-items: center;text-decoration: none">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="var(--full-color)">
            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
          </svg>
          &nbsp;
          &nbsp;
          <span style="color: var(--full-color)">
        {{$backTitle}}
      </span>
        </a>

      @endif
      <div>
        {{$title}}
      </div>
    </div>
  </div>

  <div class="back-part desktop-hidden mobile-show">
    <div style="display: flex;justify-content: space-between;border-bottom: 1px solid var(--border-color);padding-bottom: 8px;margin-bottom: 8px">
        <a href="{{$href}}" data-change-url="true" class="livewire-mode" data-emit="{{$emit}}" data-listener="profile-navigation-changed" style="display: flex;align-items: center;text-decoration: none">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="var(--full-color)">
            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
          </svg>
          &nbsp;
          &nbsp;
          <span style="color: var(--full-color)">
        {{$backTitle}}
      </span>
        </a>

      <div>
        {{$title}}
      </div>
    </div>
  </div>

</div>
