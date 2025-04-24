<div class="popup-login @if($active) active @endif">
  <div class="x-backdrop active show" wire:click.self="dismiss"></div>
  <div class="dialog-content show active" id="login-dialog" style="width: 368px;height: 400px" wire:ignore.self>

    <div class="dialog-body show active" wire:ignore.self>
      <section class="auth-parent">
        <div class="auth-container">
          <div class="x-container">
            <div class="login-logo">
              <a href="/">
                <x-logo clazz="logo"/>
              </a>
            </div>
            <div class="tac">
              <h1 class="login-h1 tar">ورود | ثبت نام</h1>
            </div>
            @if($mode=="index")
              <div class="hello">سلام!</div>
              <div class="el">لطفا شماره موبایل خود را وارد کنید</div>
            @else
              <div class="emt">لطفا کد ارسال شده به شماره موبایل {{$phone}}
                را وارد نمایید
              </div>
            @endif
            <div class="login-input-container">
              @if($mode=="index")
                <input type="tel" wire:model="phone" class="login-input" id="mobile-phone">
              @else
                <input type="tel" wire:model="code" class="login-input" id="mobile-code">
              @endif
              @if($errorText)
                <span class="input-hint">{{$errorText}}</span>
              @endif
            </div>
            @if($mode=="code")
              <div id="login-timing" style="letter-spacing: 4px;height: 48px;line-height: 48px;position: relative;top: 8px;color: var(--text-color) !important;font-weight: bold;font-size: 15px">
                @if($timedout)
                  <div style="text-align: center" wire:loading.remove>
                    <span class="link-mode" style="font-size: 14px;color: #4696ff;border-bottom: 1px dashed  #4696ff;cursor: pointer;letter-spacing: 0" wire:click="sendCode">ارسال مجدد کد</span>
                  </div>
                @else
                  {{$timeText}}
                @endif
              </div>
            @endif
            @if($mode=="index")
              <div class="mt-4">
                <button class="x-button-1 mt-4 w-100 button-styles" wire:click="sendCode">
                  <div wire:loading>
                    <span class="loader-white button-loader"></span>
                  </div>
                  <span class="text" wire:loading.remove>ارسال کد</span>
                </button>
              </div>
            @else
              <button class="x-button-1 mt-4 w-100 button-styles" wire:click="confirmCode">
                <div wire:loading>
                  <span class="loader-white button-loader"></span>
                </div>
                <span class="text" wire:loading.remove>تایید کد</span>
              </button>
            @endif
            @if($mode=="index")
              <div class="subtext tar">
                ورود شما به معنای پذیرش
                <a href="/laws" target="_blank">شرایط ماشین نو</a>
                و
                <a href="/privacy" target="_blank">قوانین حریم&zwnj;خصوصی</a>
                است
              </div>
            @else
              <div class="subtext tac">
                <span style="border-bottom: 1px dashed #199f9f;color: #199f9f;cursor: pointer" wire:click="backToIndex()">
                  بازگشت و اصلاح کد
                </span>
              </div>
            @endif
          </div>
        </div>
      </section>
    </div>
  </div>


</div>
