<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    {{--    <img src="{{asset('admin/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">--}}
    <h5 class="logo-text">{{getConfigurator()->getDashboardTitle()}}</h5>
  </div>
  <script>
    function logout() {
      $("#logout-form-admin").submit();
    }
  </script>



  <div class="tac">
    <input type="text" class="form-control" id="menu-search-input" placeholder="جست و جو" aria-label="جست و جو">
  </div>

  <ul class="sidebar-menu do-nicescrol router">
    @foreach( \App\Panel\Menu\XCacheMenus::getMenus() as $menu)
      @if(!$menu)
        @continue
      @endif
      <li class="menu">
        <a href="{{$menu->url}}" class="waves-effect">
          @if($menu instanceof \App\Panel\Menu\XMenu)
            <i style="color: {{$menu->menuIconColor}}" class="{{$menu->icon}}"></i>
            <span class="menu-title" style="color: {{$menu->menuTextColor}}">{{xTranslate($menu->pluralTitle)}}</span>
            <i class="{{$menu->arrow}} pr"></i>
          @else
            <i style="color: {{"#".$menu->getAttribute('menuIconColor')}}" class="{{$menu->icon}}"></i>
            <span class="menu-title" style="color: {{"#".$menu->getAttribute('menuTextColor')}}">{{xTranslate($menu->pluralTitle)}} </span>
            <i style="color: {{"#".$menu->getAttribute('menuIconColor')}}" class="{{$menu->arrow}} pr"></i>
          @endif
        </a>

        @if ($menu->hasSubmenu)
          <ul class="sidebar-submenu">
            @foreach($menu->submenus as $submenu)
              @if($menu instanceof \App\Panel\Menu\XMenu)
                <li >
                  <a  href="{{$submenu->url}}">
                    <i  style="color: {{$submenu->menuIconColor}}" class="{{$submenu->icon}}"></i>

                    <span style="color: {{$submenu->menuTextColor}}">
                      {{xTranslate($submenu->title)}}
                    </span>
                  </a>
                </li>
              @else
                <li><a href="{{$submenu["url"]}}"><i class="{{$submenu['icon']}}"></i>{{xTranslate($submenu['title'])}}</a></li>
              @endif
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
</div>
