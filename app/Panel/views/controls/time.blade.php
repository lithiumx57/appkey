<div class="@if($view->col) {{$view->col}}  p0 @endif li-time-picker-container">
  <label for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="text"
    style="{{$view->styles}}"
    data-format="hh:mm:ss"
    step="1"
    id="{{$name}}"
    class="form-control  {{$view->classes}} li-time-picker-input tac"
    name="{{$name}}"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
  <div class="li-time-picker" id="liTimepicker{{$name}}">
    <div class="li-time-picker-header" id="li-time-picker-header{{$name}}">
      <i class="fa fa-angle-up" id="second-up-{{$name}}"></i>
      <i class="fa fa-angle-up" id="minute-up-{{$name}}"></i>
      <i class="fa fa-angle-up" id="hour-up-{{$name}}"></i>
    </div>
    @if($object->isEditMode())
      <input type="text" class="second{{$name}}" id="second{{$name}}" value="{{explode(":",$value)[2]}}"> :
      <input type="text" class="minute{{$name}}" id="minute{{$name}}" value="{{explode(":",$value)[1]}}"> :
      <input type="text" class="hour{{$name}}" id="hour{{$name}}" value="{{explode(":",$value)[0]}}">
    @else
      <?php
      $value = old($name, "00:00:00")
      ?>
      <input type="text" class="second{{$name}}" id="second{{$name}}" value="{{explode(":",$value)[2]}}"> :
      <input type="text" class="minute{{$name}}" id="minute{{$name}}" value="{{explode(":",$value)[1]}}"> :
      <input type="text" class="hour{{$name}}" id="hour{{$name}}" value="{{explode(":",$value)[0]}}">
    @endif

    <div class="li-time-picker-footer" id="li-time-picker-footer{{$name}}">
      <i class="fa fa-angle-down" id="second-down-{{$name}}"></i>
      <i class="fa fa-angle-down" id="minute-down-{{$name}}"></i>
      <i class="fa fa-angle-down" id="hour-down-{{$name}}"></i>
    </div>
    <span class="btn btn-primary" id="confirm{{$name}}">تایید</span>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    $("body").click(function (event) {
      var id = event.target.id;
      if (id === "{{$name}}") return

      if (
        id !== "li-time-picker-footer{{$name}}" &&
        id !== "li-time-picker-header{{$name}}" &&
        id !== "second-up-{{$name}}" &&
        id !== "minute-up-{{$name}}" &&
        id !== "hour-up-{{$name}}" &&
        id !== "second{{$name}}" &&
        id !== "minute{{$name}}" &&
        id !== "hour{{$name}}" &&
        id !== "second-down-{{$name}}" &&
        id !== "minute-down-{{$name}}" &&
        id !== "hour-down-{{$name}}" &&
        id !== "liTimepicker{{$name}}"
      ) {
        if ($("#liTimepicker{{$name}}").hasClass("active")) {
          $("#{{$name}}").removeAttr("disabled")
          $("#liTimepicker{{$name}}").removeClass("active")
        }
      }
    })


    $("#{{$name}}").click(function () {
      $(this).attr("disabled", true)
      $("#liTimepicker{{$name}}").addClass("active")
    })

    var hourTag = $(".hour{{$name}}")
    var minuteTag = $(".minute{{$name}}")
    var secondTag = $(".second{{$name}}")

    var hourUpTag = $("#hour-up-{{$name}}")
    var minuteUpTag = $("#minute-up-{{$name}}")
    var secondUpTag = $("#second-up-{{$name}}")

    var hourDownTag = $("#hour-down-{{$name}}")
    var minuteDownTag = $("#minute-down-{{$name}}")
    var secondDownTag = $("#second-down-{{$name}}")


    document.getElementById("{{$name}}").addEventListener("setTimeFromValue", () => {

      let result = $("#{{$name}}").val()
      result = result.split(":")
      $("#second{{$name}}").val(result[2])
      $("#minute{{$name}}").val(result[1])
      $("#hour{{$name}}").val(result[0])


    })


    $("#confirm{{$name}}").click(function () {
      setNewValues()
      var event = new Event('timeChanged');
      event.timeValue = $('#{{$name}}').val();
      event.tagName = "{{$name}}";
      document.getElementById("{{$name}}").dispatchEvent(event);
    })

    @if(!$view->default)
    setNewValues();
    @endif

    function setNewValues() {
      var hour = parseInt(hourTag.val());
      var minute = parseInt(minuteTag.val());
      var second = parseInt(secondTag.val());

      if (!Number.isInteger(hour)) {
        hour = "00";
      } else {
        if (hour > 23) {
          hour = 0;
        }
        if (hour.toString().length === 1) {
          hour = "0" + hour;
        }
      }

      if (!Number.isInteger(minute)) {
        minute = "00";
      } else {
        if (minute > 59) {
          minute = 0;
        }
        if (minute.toString().length === 1) {
          minute = "0" + minute;
        }
      }

      if (!Number.isInteger(second)) {
        second = "00";
      } else {
        if (second > 60) {
          second = 0;
        }

        if (second.toString().length === 1) {
          second = "0" + second;
        }
      }

      $("#{{$name}}").val(hour + ":" + minute + ":" + second)

      $("#{{$name}}").removeAttr("disabled")
      $("#liTimepicker{{$name}}").removeClass("active")

    }


    hourUpTag.click(function () {
      increaseHour($(this).attr("id").replace("hour-up-", ""))
    })

    hourDownTag.click(function () {
      decreaseHour($(this).attr("id").replace("hour-down-", ""))
    })

    minuteUpTag.click(function () {
      increaseMinute($(this).attr("id").replace("minute-up-", ""))
    })

    minuteDownTag.click(function () {
      decreaseMinute($(this).attr("id").replace("minute-down-", ""))
    })

    secondUpTag.click(function () {
      increaseSecond($(this).attr("id").replace("second-up-", ""))
    })

    secondDownTag.click(function () {
      decreaseSecond($(this).attr("id").replace("second-down-", ""))
    })
  })


  function increaseHour(id) {
    var hourTag = $(".hour" + id);
    var hour = parseInt(hourTag.val());
    if (Number.isInteger(hour)) {
      var newHour = ++hour
      if (newHour === 24) {
        newHour = 0
      }
      hourTag.val(formatTime((newHour) + ""))
    } else {
      hourTag.val("00");
    }
  }

  function decreaseHour(tag) {
    var hourTag = $(".hour" + tag);
    var hour = parseInt(hourTag.val());
    if (Number.isInteger(hour)) {
      var newHour = --hour
      if (newHour === -1) {
        newHour = 23
      }
      hourTag.val(formatTime((newHour) + ""))
    } else {
      hourTag.val("00");
    }
  }

  function increaseSecond(id) {
    var tag = $(".second" + id);
    var second = parseInt(tag.val());
    if (Number.isInteger(second)) {
      var newSecond = ++second
      if (newSecond === 60) {
        newSecond = 0
      }
      tag.val(formatTime((newSecond) + ""))
    } else {
      tag.val("00");
    }
  }

  function decreaseSecond(id) {
    var tag = $(".second" + id);
    var second = parseInt(tag.val());
    if (Number.isInteger(second)) {
      var newSecond = --second
      if (newSecond === -1) {
        newSecond = 59
      }
      tag.val(formatTime((newSecond) + ""))
    } else {
      tag.val("00");
    }
  }


  function increaseMinute(id) {
    var tag = $(".minute" + id);
    var minute = parseInt(tag.val());
    if (Number.isInteger(minute)) {
      var newMinute = ++minute
      if (newMinute === 60) {
        newMinute = 0
      }
      tag.val(formatTime((newMinute) + ""))
    } else {
      tag.val("00");
    }
  }

  function decreaseMinute(id) {
    var tag = $(".minute" + id);
    var minute = parseInt(tag.val());
    if (Number.isInteger(minute)) {
      var newMinute = --minute
      if (newMinute === -1) {
        newMinute = 59
      }
      tag.val(formatTime((newMinute) + ""))
    } else {
      tag.val("00");
    }
  }

  function formatTime(hour) {
    if (hour.length === 1) {
      return "0" + hour
    }
    return hour
  }

</script>
