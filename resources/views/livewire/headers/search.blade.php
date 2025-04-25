<div wire:ignore.self id="search-popup">
  <div style="padding-top: 0;height:{{80 +100 * count($products)}}px;min-height: 100px;max-height: 400px">
    <input type="text" id="main-search-keyword" class="nb-input" wire:model.live="keyword" placeholder="جست و جو">

    @if(mb_strlen(trim($keyword)) ==0)
      <div class="tac pt-3" style="font-size: 15px">
        لطفا برنامه یا بازی خود را جست و جو کنید
      </div>
    @elseif(count($products) ==  0 )
      <div class="tac pt-3" style="font-size: 15px">
        موردی یافت نشد
      </div>
    @endif
    <div class="search-result">
      @foreach($products as $row)

        <a wire:navigate href="{{$row->value["link"]}}" class="search-row link">

          <div style="display: flex">
{{--            <img src="{{$row->getImage("webp",250)}}" alt="" style="border-radius: var(--border-radius);width: 80px">--}}
            <img src="{{@$row->value["smallImagePath"]}}" alt="" style="border-radius: var(--border-radius);width: 80px">
          </div>
          <div style="padding-right: 16px">
            <div style="font-size: 16px;font-weight: bold;margin-top: 8px">
              {{$row->value["name_fa"]}}
            </div>

          </div>
        </a>
      @endforeach
    </div>

  </div>

</div>

