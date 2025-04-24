<section>
  <div class="comments-input-container">
    <div>
      <div class="comment-title">
        {{$title}}
      </div>

      <div class="mt-3">
        <input type="text" class="button-5 w-100" wire:model="name" placeholder="نام و نام خانوادگی">
      </div>
      <div class="mt-3 mb-3">
        <input type="text" class="button-5 w-100" wire:model="username" placeholder="راه ارتباطی » ایمیل یا شماره همراه">
      </div>
    </div>

    <div>
      <textarea wire:model="description" placeholder="متن دیدگاه" class="button-5 w-100 comment-text-area"></textarea>
    </div>

  </div>
  <div>
    <button class="x-button-2 mt-3 h54" wire:click="sendComment">
      <span class="text" wire:loading.remove>ثبت دیدگاه</span>

      <div wire:loading>
        <div class="loader-white button-loader"></div>
      </div>
    </button>
  </div>
</section>
