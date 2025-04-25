<div class="p-list-container">
  <div class="x-container container-fluid p-list">
    @foreach($records as $product)
      <a wire:navigate href="{{$product->getLink()}}" class="product-row">
        <div class="product box m-0">
          <img src="{{$product->getImage("webp",1920)}}" alt="{{$product->name_en}}">
          <div class="ps-1">
            <p class="title mb-0">
              {{$product->name_fa}}
            </p>
            <div class="price">
              10000000
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>

</div>
