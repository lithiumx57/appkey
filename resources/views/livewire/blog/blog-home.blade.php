<div>

  <section class="x-container a-l-container main-container d-flex justify-content-between align-items-center w-100">

    <input class="x-input-2" type="tel" wire:model.live="keyword"
           style="width: 300px"
           placeholder="جست و جو در وبلاگ"/>
    <div class="d-flex">
      <span class="sort @if($type=="new") active @endif" wire:click="sort('new')">جدید ترین</span>
      <span class="sort @if($type=="old") active @endif" wire:click="sort('old')">قدیمی ترین</span>
    </div>

  </section>

  <section class="x-container a-l-container main-container">
    @foreach($articles as $row)

      <a wire:navigate href="{{$row->getLink()}}" class="box article-row pb-2">
        <div class="main-image">
          {!! buildChachedImage(@$row->cached_data["thumbnail"][500]) !!}
          <h2 class="title">{{$row->title}}</h2>
        </div>
        <blockquote class="article-blockqoute">{!! (\Str::substr(xEscapeHtml($row->short_description),0 ,300)) !!}...</blockquote>
      </a>
    @endforeach
  </section>

</div>
