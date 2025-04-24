<thead>
<tr>
  @foreach($heads as $head)
    @if($head->view->tdLabel !=null)
      <th>{{$head->view->tdLabel}}</th>
    @else
      <th>{{$head->view->label}}</th>
    @endif
  @endforeach
</tr>
</thead>
