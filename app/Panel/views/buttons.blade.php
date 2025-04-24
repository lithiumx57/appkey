<div class="form-group btn-group col-md-8">
  @foreach($buttons as $button)
    <button class="{{$button->classes}}" id="{{$button->id}}">
      <i class="{{$button->icon}}"></i>
      {{$button->text}}
    </button>
  @endforeach
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    $("#save-button-and-back").click(function () {
      var tag = $("#main-form");
      var url = tag.attr('action')
      if (url.includes("?")) {
        url += "&with-back-url=true";
      } else {
        url += "?with-back-url=true"
      }
      tag.attr("action", url)
      tag.submit();
    })

    $("#cancel-button").click(function () {

      let helper = document.getElementById("x-helpers")

      let route = helper.getAttribute("data-route")
      let prefix = helper.getAttribute("data-admin-prefix")
      let link
      if (prefix) link = "/" + prefix + "/" + route
      else link = "/" + route
      window.location.href = link.replaceAll("//", "/")
    })

  })
</script>
