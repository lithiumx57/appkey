<header class="container-fluid p-bg main-header">
  <div class="search-backdrop"></div>
  <div id="header-top" class="mobile-hidden desktop-show">
    <div id="header-start">
      <a wire:navigate href="/" class="notd">
        <div class="logo">
          <div class="header-logo">
            <span class="p1">App</span><span class="p2">Key</span>
          </div>
        </div>
      </a>

      <div id="header-search">
        <input type="text" placeholder="جست و جو" class="nb-input" id="temp-search" value="{{request()->input("q")}}">
        <x-font-icons.search-icon width="20px" height="20px" clazz="search-icon"/>
        <livewire:headers.search/>
      </div>
    </div>
    <div id="header-end">
      <div class="header-left-icon">
        <x-theme-switcher width="20px" height="20px"/>
      </div>
      <div class="header-left-icon">
        <a wire:navigate href="/profile" class="header-link">
          <x-font-icons.user-icon width="24px" height="24px"/>
        </a>

      </div>
      <div class="header-cart-v-divider"></div>
      <div class="header-left-icon" id="header-cart-icon">
        <a wire:navigate href="/cart" class="header-linked-icon">
          <x-font-icons.cart-icon width="24px" height="24px"/>
        </a>
        <livewire:cart.header-cartlines/>
      </div>

    </div>
  </div>
  <div id="header-bottom">
    <x-navigation/>
    <div id="menu-cover" class="desktop-show mobile-hidden"></div>

  </div>

</header>

