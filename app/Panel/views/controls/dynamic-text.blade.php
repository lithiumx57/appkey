<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <?php
  $col = "col-md-" . (12 / count($view->dynamicName));
  $inputCount = count($view->dynamicName);
  $placeolders = $view->dynamicPlaceholders;
  $names = $view->dynamicName;
  ?>

  <div id="{{$name}}">

    @if(!isEditMode())
      <div class="form-group row">
        @foreach($view->dynamicName as $key=> $row)
          <div class="{{$col}}" style="padding-left: 2px !important;margin-top: 4px">
            <label for="">
              @if(isset($placeolders[$key]))
                {{$view->dynamicPlaceholders[$key]}}
              @else
                {{$row}}
              @endif
            </label>
            <input name="{{$row}}[]" type="text" class="form-control">
          </div>
        @endforeach
      </div>
    @endif
  </div>
  <div style="text-align: center">
    <span id="add-new" class="btn btn-success">افزودن یک مورد جدید</span>
  </div>
</div>

<script>
  let colClasses = "{{$col}}"
  let inputCount = "{{$inputCount}}"
  let placeholders = JSON.parse('{!! json_encode($placeolders) !!}')
  let names = JSON.parse('{!! json_encode($names) !!}')
  let container = document.getElementById("{{$name}}")

  document.addEventListener("DOMContentLoaded", () => {
    $("#add-new").click(function () {
      addRow()
    })
  })


  @if(isEditMode() && is_array($record->$name))
  @foreach($record->$name as $row)
  addRow('{{$row}}')
  @endforeach
  @elseif(isEditMode() && is_array($view->default))
  @foreach($view->default as $row)
  addRow('{{$row}}')
  @endforeach
  @endif

  function addRow(value = null) {

    let inputContainer = document.createElement("div")
    inputContainer.classList.add("form-group", "row")


    for (let i = 0; i < names.length; i++) {
      let divChild = document.createElement("div")
      divChild.classList.add(colClasses);

      divChild.style.paddingLeft = "2px"
      divChild.style.marginTop = "4px !important"


      let label = document.createElement("label")
      if (placeholders[i]) {
        label.innerText = placeholders[i]
      } else {
        label.innerText = names[i]
      }


      let input = document.createElement("input")
      input.classList.add('form-control')
      input.setAttribute("name", names[i] + "[]")
      if (value != null)
        input.value = value


      divChild.appendChild(label)
      divChild.appendChild(input)

      inputContainer.appendChild(divChild)
    }

    inputContainer.style.position = "relative"

    let removeTag = document.createElement('i')
    removeTag.classList.add("fa", "fa-times")
    removeTag.style.position = "absolute"
    removeTag.style.cursor = "pointer"
    removeTag.style.top = "0"
    removeTag.style.left = "0"

    removeTag.addEventListener("click", function () {
      inputContainer.remove()
    })


    inputContainer.appendChild(removeTag)

    container.appendChild(inputContainer)
  }

</script>
