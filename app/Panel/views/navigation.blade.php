<h1 style="direction: rtl;font-size: 14px;position: absolute;top: 0;right: 24px">

  <?php
  $prefix = getConfigurator()->prefix();
  ?>
  <a href="{{buildRoute($prefix)}}"><i class="fa fa-home"></i>&nbsp;<span><span>داشبورد</span></span></a>
  @foreach($path as $p)
    <span class="fa fa-angle-left"></span>
    @if($p['url']=="")
      <?php $link = ""; ?>
    @else
      <?php
        $link =  buildRoute($p['url']); ?>
    @endif
    <a href="{{$link}}"><span><span>{{$p['title']}}</span></span></a>
  @endforeach
</h1>
