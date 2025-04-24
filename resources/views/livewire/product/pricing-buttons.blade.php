<div class="buttons">
  @if(count($data["attributeValues"])>0)
    @foreach($data["attributeValues"] as $key=>$value)
      <div class="buttons-container">
        <span class="p-label">{{$data["attributes"][$key]["label"]}}</span>
        <div class="pt-2 mt-2 buttons-line">
          @foreach($value as $key2=>$value2)
            <span class="me-2 x-button-1" wire:click="buttonClicked({{$value2["id"]}},{{$key}})">
            @if(@$selection[$key] ==$value2["id"])
                <x-font-icons.check width="20" height="20" clazz="p-button-check"/>
              @endif
              {{$value2["label"]}}
          </span>
            &nbsp;&nbsp;&nbsp;
          @endforeach
        </div>
      </div>
    @endforeach

    <div class="p-divider mt-2"></div>

    <div class="mt-2">
      <x-toman :text="$priceText" :showToman="$isSelected"/>
    </div>

    <div class="mt-2">
      @if($isSelected)
        <button class="x-button-2 p-2 atcwh h54" wire:click="addToCart">
          <div wire:loading>
            <span class="loader-white button-loader"></span>
          </div>
          <span wire:loading.remove class="text">افزودن به سبد خرید</span>
        </button>
      @endif
    </div>
  @endif
</div>
