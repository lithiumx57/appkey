<div class="profile-container">

  <div class="navigation box profile-navigation  @if($path!="/") mobile-hidden desktop-show @endif">
    <ul class="w-100">
      <li class="box">
        <a href="/profile" class="livewire-mode  p-nav-link {{$path=="/"?"active":""}}" data-emit="/" data-listener="profile-navigation-changed">
          <x-font-icons.dounble-angle-left width="12" height="12"/>
          داشبورد
        </a>
      </li>
      <li class="box">
        <a href="/profile/wallet" data-change-url="true" class="livewire-mode p-nav-link {{$path=="wallet"?"active":""}}" data-emit="wallet" data-listener="profile-navigation-changed">
          <x-font-icons.dounble-angle-left width="12" height="12"/>
          کیف پول
        </a>
      </li>
      <li class="box">
        <a href="/profile/orders" data-change-url="true" class="livewire-mode p-nav-link {{$path=="orders"?"active":""}}" data-emit="orders" data-listener="profile-navigation-changed">
          <x-font-icons.dounble-angle-left width="12" height="12"/>
          سفارشات
        </a>
      </li>

      <li class="box">
        <a href="/profile/favorites" data-change-url="true" class="livewire-mode p-nav-link {{$path=="favorites"?"active":""}}" data-emit="favorites" data-listener="profile-navigation-changed">
          <x-font-icons.dounble-angle-left width="12" height="12"/>
          علاقه مندی ها
        </a>
      </li>

      <li class="box">
        <a href="/profile/authentication" data-change-url="true" class="livewire-mode p-nav-link {{$path=="authentication"?"active":""}}" data-emit="authentication" data-listener="profile-navigation-changed">
          <x-font-icons.dounble-angle-left width="12" height="12"/>
          احراز هویت
        </a>
      </li>

    </ul>
  </div>

  @if($path!="/")
    <div class="w-100 content box p-bg">
      @if($path=="orders" && is_null($p1))
        {{--        <div class="box p-1 p-breadcrumb">--}}
        {{--          <ul>--}}
        {{--            <li>--}}
        {{--              <a href="/">پروفایل </a>--}}
        {{--              <x-font-icons.dounble-angle-left width="12" height="12" clazz="full-color"/>--}}
        {{--            </li>--}}
        {{--            <li>--}}
        {{--              <a href="/">سفارشات</a>--}}
        {{--              <x-font-icons.dounble-angle-left width="12" height="12" clazz="full-color"/>--}}
        {{--            </li>--}}
        {{--            <li>--}}
        {{--              <a href="/">مشاهده سفارش</a>--}}
        {{--            </li>--}}
        {{--          </ul>--}}
        {{--        </div>--}}

        <livewire:profile.profile-orders/>
      @elseif($path=="orders" && $p1=="show" && is_numeric($p2))
        <livewire:profile.profile-order-show :order-id="$p2"/>
      @elseif($path=="favorites")
        <livewire:profile.profile-favorites/>
      @elseif($path=="authentication")
        <livewire:profile.profile-authentication/>
      @elseif($path=="wallet")
        <livewire:profile.profile-wallet/>
      @endif
    </div>
  @else
    <livewire:profile.profile-dashboard/>
  @endif


</div>
