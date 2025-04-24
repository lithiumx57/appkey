<br>
<br>
@foreach(\App\Panel\Models\Head::getHeads() as $key=> $head)
  <div style="box-shadow: 2px 2px 112px 3px #333;width: 500px;border-radius: 4px;padding: 8px;display: inline-block;margin-left: 8px;margin-top: 8px">
    <h4 style="color: #2293ff">{{$key}}</h4>
    @foreach($head as $row)
      <?php $name=$row['prefix']."_".$row['name'] ?>
      <div class="form-group col-md-12 col-xs-12">
        <label for="{{$name}}">{{$row['title']}}</label>
        @if($row['type']=="input")
          <input type="{{$row['type']}}" class="form-control" id="{{$name}}" name="{{$name}}" value="{{old($name,\App\Panel\Models\Head::getRow($name)->value)}}">
        @else
          <textarea name="{{$name}}" id="{{$name}}" class="form-control" cols="30" rows="4">{{\App\Panel\Models\Head::getRow($name)->value}}</textarea>
        @endif
      </div>
    @endforeach
  </div>
@endforeach
