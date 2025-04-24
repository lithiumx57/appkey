<div x-data="{ currentPage: @entangle('currentPage').defer }">
  <!-- منوی نویگیشن -->
  <nav>
    <ul>
      <li>
        <button wire:click="setPage('home')">خانه</button>
      </li>
      <li>
        <button wire:click="setPage('about')">درباره ما</button>
      </li>
      <li>
        <button wire:click="setPage('contact')">تماس</button>
      </li>
    </ul>
  </nav>

  <!-- محتوای دینامیک -->
  <div class="content" x-show="currentPage === 'home'">
    <h1>صفحه خانه</h1>
    <p>به صفحه اصلی خوش آمدید! اینجا یک محتوای تستی است.</p>
  </div>

  <div class="content" x-show="currentPage === 'about'">
    <h1>درباره ما</h1>
    <p>ما یک تیم هستیم که عاشق کدنویسی و خلاقیتیم.</p>
  </div>

  <div class="content" x-show="currentPage === 'contact'">
    <h1>تماس با ما</h1>
    <p>برای ارتباط: test@example.com</p>
  </div>
</div>
