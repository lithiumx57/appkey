<div {!! $additionalData !!}>

  <label for="tag{{$name}}">{{$view->label}}</label>
  <br>
  <input id="tag{{$name}}" type="text" class="form-control tag-input {{$view->classes}}"
         placeholder="{{$view->placeholder}}">
  <span id="addTag{{$name}}" class="btn btn-success tag-button">افزودن</span>
  <input type="hidden" name="{{$name}}" id="{{$name}}" value="{{old($name)}}">


  <br><br>
  <div class="form-group col-md-12 col-xl-8">
    <div id="t_container{{$name}}">
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var tagContainer = document.getElementById("t_container{{$name}}");
      @if($object->isEditMode())

        <?php
        $result = $object->getTags($record);

        if (!$result) {
          $result = $object->view->default;
        }

        ?>
      var oldTags = '{{old($name,$result)}}';
      @else
      var oldTags = '{{old($name,$view->default)}}';

      @endif

      if (oldTags === "") {
        document.getElementById("{{$name}}").value = ""
      }

      oldTags = oldTags.split("|");
      $("#{{$name}}").val("")
      for (var i = 0; i < oldTags.length; i++) {

        if (oldTags[i].trim().length === 0) {
          continue;
        }
        addTag(oldTags[i]);
      }

      var addTagButton = document.getElementById("addTag{{$name}}")

      $("#tag{{$name}}").on("keyup", function (event) {
        event.stopPropagation()
        event.preventDefault();
        if (event.key.toLowerCase() === "enter") {
          $("#addTag{{$name}}").click()
          $("#tag" + {{$name}}).focus()
        }
      })

      addTagButton.addEventListener("click", function () {

        var tagInput = document.getElementById("tag{{$name}}")
        var tagInputValue = tagInput.value

        var array = tagInputValue.split("|")
        for (var t in array) {
          var tag = array[t];
          addTag(tag)
        }
        tagInput.value = "";
      })


      function deleteTag(tag, text) {
        var tagsInput = document.getElementById("{{$name}}")
        tagsInput.value = tagsInput.value.replace("|" + text + "|", "")
        tag.parentNode.remove()
      }

      function addTag(title) {
        if (title.trim() === "") return
        var hiddenTagInput = document.getElementById("{{$name}}")
        var hiddenTagInputValue = hiddenTagInput.value
        hiddenTagInput.value = hiddenTagInputValue + "|" + title + "|"

        var newTag = document.createElement("span")
        newTag.classList.add("tagItem")
        var span = document.createElement("span")
        span.innerText = title
        newTag.appendChild(span)
        var icon = document.createElement("span")
        icon.classList.add("fa", "fa-close", 'removeItem')
        icon.addEventListener("click", function () {
          deleteTag(icon, title)
        })
        newTag.appendChild(icon)
        tagContainer.appendChild(newTag)
      }
    })


  </script>

</div>
