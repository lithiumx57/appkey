<div class="footer">
  <div class="x-container">
    <div class="footer-top">
      <div class="links-container">
        <div class="footer-f-p">
          <x-logo/>
          <div class="t-r">
            با ما تماس بگیرید
          </div>
          <div class="t-r">
            تایم کاری 12 ظهر تا 8 شب
          </div>
          <div class="t-r">
            تلفن تماس :
            021-91691297
          </div>

          <div class="mt-2">
            <div class="social-title">
              راه های ارتباطی
            </div>
            <div class="socials-container">
              @foreach($socials as $social)
                <a href="{{$social->link}}" target="_blank" title="{{$social->title}}">
                  {!! $social->svg !!}
                </a>
              @endforeach
            </div>
          </div>

        </div>
        <div class="links">
          <div class="footer-s-p">
            <h3 class="title">
              دسترسی سریع
            </h3>

            <ul>
              <li>
                <a wire:navigate href="/about-us">درباره ما</a>
              </li>
              <li>
                <a  wire:navigate href="/contact-us">تماس با ما</a>
              </li>
              <li>
                <a  wire:navigate href="/laws">قوانین و مقررات</a>
              </li>
              <li>
                <a  wire:navigate href="/faqs">سوالات پر تکرار</a>
              </li>
              <li>
                <a wire:navigate href="/privacy">حریم خصوصی</a>
              </li>
              <li>
                <a wire:navigate href="/blog">وبلاگ</a>
              </li>
            </ul>
          </div>

          <div class="footer-t-p">
            <h3 class="title">
              پلتفرم ها
            </h3>
            <ul>
              <li>
                <a  wire:navigate href="/platforms/steam">استیم</a>
              </li>
              <li>
                <a wire:navigate href="/platforms/battlenet">بتل نت</a>
              </li>
              <li>
                <a wire:navigate href="/platforms/uplay">یوپلی</a>
              </li>
              <li>
                <a wire:navigate href="">اگزیت لگ</a>
              </li>

            </ul>
          </div>
        </div>
      </div>
      <div>
        <div class="namad-title">
          نماد های الکترونیکی
        </div>
        <div class="footer-n-p">
          <img src="{{buildCdnPath('app/enamad.png')}}" alt="">
          <img src="{{buildCdnPath('app/samandehi.png')}}" alt="">
        </div>
      </div>
    </div>

    <div class="copy-right">
      © 2020 – 2025 کلیه حقوق مادی و معنوی سایت برای گروه appkey.ir محفوظ میباشد و کپی برداری به هرشکل پیگرد قانونی دارد.
    </div>
  </div>

</div>
