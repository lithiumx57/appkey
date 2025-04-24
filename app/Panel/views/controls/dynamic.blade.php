<div {!! $additionalData !!} style=";margin: auto;background: rgba(71,71,71,.3);padding: 8px;border-radius: 4px" class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>

  <i style="float: left;margin: 4px;cursor: pointer" id="plus_{{$name}}" class="fa fa-plus"></i>

  <div id="{{$name}}">

  </div>
</div>

<script>
  var content{{$name}} = document.getElementById("{{$name}}")
  document.addEventListener("DOMContentLoaded", function () {
    var old = JSON.parse('{!! json_encode(old($name,$object->isEditMode()?$object->$name:null)) !!}')
    if (Array.isArray(old)) {
      var result = 0;
      for (var i = 0; i < old.length; i++) {
        var row = old[i]
        if (row) {
          result++
          generateTag{{$name}}(row)
        }
      }
      if (result === 0) generateTag()
    } else {
      generateTag{{$name}}()
    }
  })

  function generateTag{{$name}}(value = null) {
    var container = document.createElement("div")
    container.style.position = "relative"
    var input = document.createElement("{{$view->dynamicTagName}}")
    input.setAttribute("type", "{{$view->dynamicType}}")
    input.setAttribute("name", "{{$name}}[]")
    input.classList.add("form-control")
    input.style.marginTop = "4px"
    input.value = value
    var remove = document.createElement("i")
    remove.classList.add("fa", "fa-times")
    remove.style.position = "absolute"
    remove.style.left = "3px"
    remove.style.top = "3px"
    remove.style.cursor = "pointer"
    remove.addEventListener("click", function () {
      container.remove()
    })

    container.appendChild(remove)
    container.appendChild(input)
    content{{$name}}.appendChild(container)
  }

  var plus = document.getElementById("plus_{{$name}}")
  plus.addEventListener("click", function () {
    generateTag{{$name}}()
  })


</script>
