<header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu tac">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
      <li>
        @yield("header")
      </li>
      @if(isset($model) && $model::isActiveSearch())
        <ul style="list-style: none;margin: 0;padding: 0">
          <li class="nav-item">
            <div class="search-bar">
              <input data-target="{{$searchRoute}}" name="q" id="search-keyword" type="text" class="form-control" value="{{$q}}" placeholder="جست و جو" aria-label="جست و جو">
              <a href="javascript:void(0);"><i class="icon-magnifier"></i></a>
            </div>
          </li>
        </ul>
      @endif
    </ul>
{{--    @if(count(getConfigurator()->getLanguages()) > 0)--}}
{{--        <?php--}}
{{--        $defaultLangage = getLanguage();--}}
{{--        ?>--}}
{{--      <div class="" dir="ltr">--}}
{{--        <i class="fa fa-language"></i>--}}
{{--        @foreach(\App\Panel\Models\Language::where("type","dashboard")->get() as $language)--}}
{{--          &nbsp;--}}
{{--          <a href="{{getConfigurator()->prefix()?"/".getConfigurator()->prefix():""}}/lang/{{$language->name}}" class="d-language @if($defaultLangage==$language->name) active @endif" title="{{$language->title}}">{{$language->name}}</a>--}}
{{--        @endforeach--}}
{{--      </div>--}}
{{--    @endif--}}

    <livewire:public-components.header-icons/>

  </nav>
</header>
