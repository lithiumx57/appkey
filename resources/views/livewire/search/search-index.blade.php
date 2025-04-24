<div id="search-container" class="{{$clazz}}">
  <x-logo clazz="search-logo"/>
  <div class="main-search-container">
    <input wire:model.live="keyword" type="text" id="main-search-keyword" placeholder="کلیدواژه">
    <x-font-icons.search-icon :width="16" :height="16" clazz="search-icon"/>
  </div>

  <div style="position: absolute;top: 120px;width: calc(100% - 40px);margin-right: 16px">
    @foreach($records as $row)
      <div style="display: flex;background: #fff;padding: 8px;border-radius: var(--border-radius);margin-top: 8px;align-items: center">
        <div style="display: flex">
          <img src="{{$row->getImage("webp",250)}}" alt="" style="border-radius: var(--border-radius);width: 42px;height: 54px">
        </div>
        <div style="padding-right: 16px">
          <div style="font-size: 14px;font-weight: bold">
            {{$row->name_fa}}
          </div>
          <div style="font-size: 13px">
            {{$row->getAttr("platform")}} - {{$row->getAttr("console")}} - {{$row->getAttr("creator")}}
          </div>
        </div>
      </div>
    @endforeach
  </div>

</div>
