new Swiper(".main-slider",{on:{click(r,s){const e=s.target.closest("a[wire\\:navigate]");if(e){const t=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window});e.dispatchEvent(t)}}},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},autoplay:{delay:3e4,disableOnInteraction:!1,pauseOnMouseEnter:!0},breakpoints:{0:{slidesPerView:1.2,spaceBetween:8},440:{slidesPerView:1.2,spaceBetween:8},570:{slidesPerView:1.3,spaceBetween:8},640:{slidesPerView:1.3,spaceBetween:8},768:{slidesPerView:1.4,spaceBetween:8},900:{slidesPerView:1.5,spaceBetween:8},1024:{slidesPerView:1.6,spaceBetween:12},1300:{slidesPerView:1.63,spaceBetween:12}},pagination:{el:".slider-swiper-pagination"},slidesPerView:1.1,spaceBetween:30,centeredSlides:!0,loop:!0});new Swiper(".product-slider",{on:{click(r,s){const e=s.target.closest("a[wire\\:navigate]");if(e){const t=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window});e.dispatchEvent(t)}}},slidesPerView:2.8,spaceBetween:8,breakpoints:{0:{slidesPerView:2.8,spaceBetween:8},440:{slidesPerView:2.5,spaceBetween:8},570:{slidesPerView:2.7,spaceBetween:8},640:{slidesPerView:3.1,spaceBetween:8},768:{slidesPerView:3.5,spaceBetween:8},900:{slidesPerView:4,spaceBetween:8},1024:{slidesPerView:4.8,spaceBetween:12},1300:{slidesPerView:5.8,spaceBetween:12}},pagination:{el:".swiper-pagination",clickable:!0}});new Swiper(".category-slider",{on:{click(r,s){const e=s.target.closest("a[wire\\:navigate]");if(e){const t=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window});e.dispatchEvent(t)}}},slidesPerView:4,spaceBetween:8,pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{0:{slidesPerView:4.2,spaceBetween:8},440:{slidesPerView:5,spaceBetween:8},570:{slidesPerView:5.2,spaceBetween:8},640:{slidesPerView:6.1,spaceBetween:8},768:{slidesPerView:7.2,spaceBetween:8}}});new Swiper(".blog-slider",{on:{click(r,s){const e=s.target.closest("a[wire\\:navigate]");if(e){const t=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window});e.dispatchEvent(t)}}},spaceBetween:8,pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{0:{slidesPerView:3,spaceBetween:8},440:{slidesPerView:2.1,spaceBetween:8},570:{slidesPerView:2.8,spaceBetween:8},640:{slidesPerView:3.1,spaceBetween:8},768:{slidesPerView:3.6,spaceBetween:8},900:{slidesPerView:4.1,spaceBetween:8},1024:{slidesPerView:4.8,spaceBetween:12},1300:{slidesPerView:5.8,spaceBetween:12}}});(function(){class r extends HTMLElement{constructor(){if(super(),this.shadowRoot)return;const e=this.getAttribute("data-width")||150,t=this.getAttribute("data-height")||100;this.frameWidth=e,this.frameHeight=t,this.frames=[],this.currentAngle=0,this.increment=.16,this.initialized=!1,this.attachShadow({mode:"open"}),this.shadowRoot.innerHTML=this.getTemplate()}connectedCallback(){if(this.initialized)return;this.initialized=!0,this.overlay=this.shadowRoot.querySelector(".overlay"),this.carouselContainer=this.shadowRoot.querySelector(".carousel-container"),this.primaryWindow=this.shadowRoot.querySelector(".primary-window"),this.frameContainer=this.shadowRoot.querySelector(".frame-container"),this.shadowContainer=this.shadowRoot.querySelector(".shadow-container");const e=Array.from(this.children),t=this.frameWidth*e.length/(1.2*3.2);this.primaryWindow.style.translate=`0 0 ${t}px`,e.forEach((i,n)=>{const o=i.cloneNode(!0),l=i.cloneNode(!0);l.classList.add("shadow"),this.frames.push(i),i.style.transformOrigin=`50% 50% ${-t}px`,i.style.translate=`0 0 ${t}px`,i.initialRotation=360/e.length*n,i.rotation=i.initialRotation,i.style.rotate=`y ${i.initialRotation}deg`,i.addEventListener("click",()=>{}),this.overlay.addEventListener("click",c=>{c.target===this.overlay&&(this.overlay.classList.remove("open"),o.classList.remove("open"))});const a=document.createElement("div");a.classList.add("shadow-wrap"),a.style.transformOrigin=`50% 50% ${-t}px`,a.style.translate=`0 0 ${t}px`,a.style.rotate=`y ${360/e.length*n}deg`,a.appendChild(l),this.shadowContainer.appendChild(a),this.overlay.appendChild(o)}),this.midX=this.clientWidth/2,this.midY=this.clientHeight/2,this.rotateCarousel(),this.setupListeners()}setupListeners(){this.carouselContainer.addEventListener("mousemove",t=>{const i=this.getBoundingClientRect(),n=t.clientX-i.left;n>this.midX+25?this.increment=.16:n<this.midX-25?this.increment=-.16:this.increment=0}),this.carouselContainer.addEventListener("mouseout",()=>{this.increment=.16});let e=null;this.carouselContainer.addEventListener("touchstart",t=>{t.touches.length===1&&(e=t.touches[0].clientX)}),this.carouselContainer.addEventListener("touchmove",t=>{if(t.touches.length===1&&e!==null){const i=t.touches[0].clientX,n=i-e;Math.abs(n)>5&&(this.increment=n>0?.16:-.16,e=i)}}),this.carouselContainer.addEventListener("touchend",()=>{e=null,this.increment=.16}),window.addEventListener("resize",()=>{this.midX=this.clientWidth/2,this.midY=this.clientHeight/2})}rotateCarousel(){this.currentAngle%360>-Math.abs(this.increment)&&this.currentAngle%360<Math.abs(this.increment)&&(this.currentAngle=0,this.frames.forEach(e=>e.rotation=e.initialRotation)),this.frames.forEach(e=>{e.rotation+=this.increment,this.applyOpacity(e)}),this.currentAngle+=this.increment,this.frameContainer.style.transform=`rotateY(${this.currentAngle}deg)`,requestAnimationFrame(()=>this.rotateCarousel())}applyOpacity(e){const t=e.rotation%360;t>=0&&t<=45||t>=315&&t<=360?e.style.opacity="1":t>45&&t<=90||t>=270&&t<315?e.style.opacity="0.8":t>90&&t<=135||t>=225&&t<270?e.style.opacity="0.6":e.style.opacity="0.4"}getTemplate(){return`
        <style>
          :host {
            display: inline-block;
            width: 100%;
            height: 100%;
          }
          .overlay {
            position: fixed;
            display: grid;
            place-items: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,.6);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
          }
          .overlay > * {
            position: absolute;
            width: 70%;
            height: 70%;
            border-radius: 9px;
            opacity: 0;
            object-fit: cover;
          }
          .carousel-container {
            display: grid;
            place-items: center;
            width: 100%;
            height: 100%;
            perspective: 1000px;
            perspective-origin: 50% 30%;
            overflow: hidden;
          }
          .floor {
            position: absolute;
            width: 400%;
            height: 400%;
            background-size: 100%, 100px 100px;
            transform: translateY(${this.frameHeight/2+20}px) rotateX(90deg);
          }
          .frame-container {
            position: absolute;
            width: ${this.frameWidth}px;
            height: ${this.frameHeight}px;
            transform-style: preserve-3d;
          }
          .shadow-container, .shadow-wrap {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
          }
          .shadow-wrap {
            transform: translateY(calc(50% + 20px));
          }
          .shadow {
            transform: rotateX(-90deg) translateY(-${this.frameHeight/2}px);
            -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,.7), transparent 70%);
            mask-image: linear-gradient(to top, rgba(0,0,0,.7), transparent 70%);
          }
          ::slotted(*), .shadow {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 5px;
            background-color: transparent;
            transition: opacity 0.5s;
          }
          ::slotted(*) {
            cursor: pointer;
          }
        </style>
        <div class="carousel-container">
          <div class="floor"></div>
          <div class="frame-container">
            <slot></slot>
            <div class="shadow-container"></div>
          </div>
          <div class="primary-window"></div>
        </div>
        <div class="overlay"></div>
      `}}customElements.get("carousel-3d-auto")?document.querySelectorAll("carousel-3d-auto").forEach(s=>{typeof s.connectedCallback=="function"&&s.connectedCallback()}):customElements.define("carousel-3d-auto",r)})();
