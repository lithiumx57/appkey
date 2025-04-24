var helpers = document.getElementById("x-helpers");
var adminPrefix = helpers.getAttribute("data-admin-prefix")
var useXTable = helpers.getAttribute("data-use-x-table") === "1"
var isTrashMode = helpers.getAttribute("data-is-trash-mode") === "1"
var route = helpers.getAttribute("data-route")
var csrf = $('meta[name="csrf-token"]').attr('content');


function deleteFormById(formId, message, isRecycleMode = false) {

  var confirmButtonText;
  if (isRecycleMode) {
    confirmButtonText = {
      confirmButtonText: 'بله ، بازیافت شود !',
    }
  } else {
    confirmButtonText = {
      confirmButtonText: 'بله ، حذف شود !',
    }
  }

  Swal.fire({
    title: message,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    ...confirmButtonText,
    cancelButtonText: 'خیر',
  }).then((result) => {
    if (result.value) {
      var tag = document.getElementById(formId)
      $("#" + formId).submit()
    }
  });
}


function deleteForm(route, message, isDeleteMode) {

  var form = document.createElement("form");

  if (route.includes("?")) {
    var separator = "&"
  } else {
    separator = "?";
  }


  var target = "";
  if (isDeleteMode) {
    target = route + separator + "mode=delete";
  } else {
    target = route + separator + "mode=restore";
  }
  var url = window.location.href;
  if (url.includes("x-action=true")) {
    target += "&x-action=true"
  }

  form.action = target;

  form.method = "POST";
  form.style.display = "none";
  var csrf = document.createElement("input");
  csrf.value = $("#csrf").attr("content");
  csrf.name = "_token";
  form.appendChild(csrf);

  var method = document.createElement("input");
  method.value = "DELETE";
  method.name = "_method";
  form.appendChild(method);
  document.body.appendChild(form);


  if (isDeleteMode) {
    confirmButtonText = {
      confirmButtonText: 'بله!',
    }
  } else {
    confirmButtonText = {
      confirmButtonText: 'بله!',
    };
  }

  Swal.fire({
    title: message,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    ...confirmButtonText,
    cancelButtonText: 'خیر',
  }).then((result) => {
    if (result.value) {
      form.submit();
    }
  });

}


var urls = [];
var allTags = $(".sidebar-menu a");
var i;
for (i = 0; i < allTags.length; i++) {
  urls.push($(allTags[i]));
}


var currentUrl = window.location.href;
$('.sidebar-submenu').removeClass('active')
for (i = 0; i < urls.length; i++) {
  var tag = urls[i];
  var url = urls[i].attr('href');
  if (url == currentUrl) {
    tag.parent().parent().parent().addClass('active');
    tag.parent().addClass('active');
  }
}

function setupEditor(id, locale = "fa") {
  CKEDITOR.config.language = locale;
  CKEDITOR.config.filebrowserUploadUrl =  adminPrefix + "/ckUploader";
  CKEDITOR.config.filebrowserBrowseUrl =  adminPrefix + "/ckUploader";
  CKEDITOR.config.filebrowserUploadMethod = "form";
  CKEDITOR.config.skin = 'office2013';
  // config.extraPlugins = '';
  CKEDITOR.config.extraPlugins = ['html5audio', 'html5video'];
  CKEDITOR.replace(id)
}


$(".select-checkbox").click(function () {
  initAfterCheck()
});

function initAfterCheck() {
  var allCheckboxes = $(".select-checkbox");
  var selectedCheckboxes = allCheckboxes.filter(":checked");
  if (selectedCheckboxes.length > 0) {
    $(".multipleDelete").removeClass("disabled");
  } else {
    $(".multipleDelete").addClass("disabled");
  }
}

$(function () {
  var allCheckboxes = $(".select-checkbox");
  var selectedCheckboxes = allCheckboxes.filter(":checked");
  if (selectedCheckboxes.length > 0) {
    $(".multipleDelete").removeClass("disabled");
  }
});

function multipleDelete(route, name, mode) {

  var allCheckboxes = $(".select-checkbox");
  var selectedCheckboxes = allCheckboxes.filter(":checked");
  if (selectedCheckboxes.length > 0) {
    var title = "";
    if (mode === "delete") {
      title = name + " های انتخاب شده به سطل زباله منتقل شوند؟";
    } else if (mode === "deleteForEver") {
      title = name + " های انتخاب شده برای همیشه حذف شوند؟";
    } else if (mode === "restore") {
      title = name + "  های انتخاب شده بازیابی شوند؟ ";
    }

    var parameters = $("#recycle-form").attr("data-parameters");
    if (parameters) {
      if (route.includes("?")) {
        parameters = JSON.parse(parameters)
        var result = getQueryParameters(parameters, "");
        result = result.replace("?", "&");
        route += result;
      }
    }

    $("#recycle-form").attr("action", route);
    Swal.fire({
      title: title,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'بله!',
      cancelButtonText: 'خیر',
    }).then((result) => {
      if (result.value === true)
        $("#recycle-form").submit();
    });

  } else {
    warningMessage("هیچ آیتمی انتخاب نشده است")
  }
}

function customOption(route, name, fillable, selectMode = true, data) {
  var allCheckboxes = $(".select-checkbox");
  var selectedCheckboxes = allCheckboxes.filter(":checked");
  $("#x-option-data").val(data)
  var form = $("#recycle-form");
  form.attr("action", route);
  if (selectedCheckboxes.length > 0 || !selectMode) {
    form.submit()
  } else {
    warningMessage("هیچ آیتمی انتخاب نشده است")
  }
}

const getToken = () => {
  return {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }
}

function popupOption(index, checkable, model, mode, requestedModel, customId = -1, type = "option") {

  model = JSON.parse(model)
  requestedModel = JSON.parse(requestedModel)

  var finalModels = "";
  for (let j = 0; j < model.length; j++) {
    finalModels += "\\" + model[j];
  }

  var finalRequestedModel = "";
  for (let k = 0; k < requestedModel.length; k++) {
    finalRequestedModel += "\\" + requestedModel[k];
  }

  var isAction;

  requestedModel = finalRequestedModel;
  model = finalModels;

  if (customId > 0) {
    record = customId;
    isAction = true;
  } else {
    isAction = false;
    var record = -1;
    if (checkable === "1") {
      var rows = $(".select-checkbox");
      for (var j = 0; j < rows.length; j++) {
        if ($(rows[j]).is(":checked")) {
          record = $(rows[j]).val();
        }
      }
    }
  }


  if (record === -1 && checkable === "1") {
    warningMessage("لطفا ابتدا یک مورد را انتخاب کنید")
    return;
  }
  $(".popup-dialog").empty()


  if (isAction) {
    $("#popupDialog-action").addClass("active")
  } else {
    $('#popupDialog' + index).addClass("active")
  }

  // $('.popup-dialog').addclass("active")
  $.ajax({
    url:  adminPrefix + "/pre-show-popup-option",
    method: "post",
    ...getToken(),
    data: {
      index,
      checkable,
      model,
      record,
      mode,
      type,
      requestedModel
    }
  }).done(function (data) {
    if (isAction) {
      $("#popupDialog-action").empty().append(data)
      $(".popup-dialog .close").click(function () {
        $(this).parent().parent().removeClass("active")
      })
    } else {
      $('#popupDialog' + index).empty().append(data)
      $(".popup-dialog .close").click(function () {
        $(this).parent().parent().removeClass("active")
      })
    }

  })
}


function multipleChange(route, name, fillable, selectMode = true, data) {

  var allCheckboxes = $(".select-checkbox");
  var title = "وضعیت " + name + " های انتخاب شده تغییر پیدا کند؟ ";
  var selectedCheckboxes = allCheckboxes.filter(":checked");

  if (selectMode) {
    $("#x-option-data").val(data)
  }

  if (selectedCheckboxes.length > 0 || !selectMode) {
    if (selectMode) {
      route =adminPrefix + "/" + route + "/-1?type=switch&fillable=" + fillable
    }

    $("#recycle-form").attr("action", route);

    if (selectMode) {
      Swal.fire({
        title: title,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله!',
        cancelButtonText: 'خیر',
      }).then((result) => {
        if (result.value === true)
          $("#recycle-form").submit();
      });
    } else {
      $("#recycle-form").submit();
    }

  } else {
    warningMessage("هیچ آیتمی انتخاب نشده است")
  }
}

function callFormOption(route, name, fillable, data) {
  var form = document.createElement("form")
  form.style.display = "none";
  form.setAttribute("method", "post")
  form.setAttribute("action", route)

  var input = document.createElement("input");
  input.name = "_token";
  input.id = "_token";
  input.value = csrf;

  var xOptionData = document.createElement("input");
  xOptionData.name = "x-option-data";
  xOptionData.id = "x-option-data";
  xOptionData.value = data;


  var method = document.createElement("input");
  method.name = "_method";
  method.id = "_method";
  method.value = "delete";


  form.appendChild(input)
  form.appendChild(method)
  form.appendChild(xOptionData)

  document.body.appendChild(form)

  form.submit()
}

function successMessage(message) {
  Swal.fire({
    title: message,
    type: "success",
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'بسیار خب',
  }).then((result) => {
  });
}

function warningMessage(message) {
  Swal.fire({
    title: message,
    type: "warning",
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'بسیار خب',
  }).then((result) => {
  });
}

document.addEventListener("DOMContentLoaded", function () {
  setupActions()
  if (useXTable) {
    $('[data-toggle="tooltip"]').tooltip();
    createPagination()
    initXSearch()
  } else {
    var table = $('#categories-datatable').DataTable({
      lengthChange: true,
      buttons: ['copy', 'excel', 'print', 'colvis'],
      responsive: true,
      "lengthMenu": [[50, 80, 120, 180, 200, -1], [50, 80, 120, 180, 200, "همه موارد"]],
    });
    table.buttons().container()
      .appendTo('.navbar');
  }


})


function bindAfterChange() {
  var DOMContentLoaded_event = document.createEvent("Event")
  DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)
  window.document.dispatchEvent(DOMContentLoaded_event)

}

var page = 1
var keyword = "";


function initXSearch() {

  var searchTag = $("#search")
  var searchVal = searchTag.val();

  if (searchVal) {
    keyword = searchVal;
    search();
  }


  searchTag.on("keyup", function () {
    var value = $(this).val();
    if (keyword === value) {
      return
    }

    if (keyword === value.trim()) {
      return
    }
    keyword = value
    page = 1;
    search()
  })
}


function search() {

  var url =adminPrefix + "/" + route + "?type=search";
  if (isTrashMode) {
    url += "&recycle-bin=true"
  }

  $.ajax({
    ...getToken(),
    url: url,

    data: {
      keyword,
      page,
      isTrashMode
    }
  }).done(function (data) {
    $("#tbody").empty().append(data)
    bindAfterChange()
  })
}


function createPagination() {
  var paginateHelper = $(".paginate-helper")[0]


  var pagination = $(".pagination")

  if (!paginateHelper) {
    pagination.removeClass("active")
    return;
  }

  var currentPage = parseInt(paginateHelper.getAttribute("data-current-page"))


  var total = parseInt($(paginateHelper).data("total"))
  var perPage = parseInt($(paginateHelper).data("perpage"))

  var len = Math.ceil(total / perPage)

  if (len <= 1) {
    pagination.removeClass("active")
  } else {
    pagination.addClass("active")
  }


  pagination.empty()


  var prev = document.createElement("a")
  prev.id = "page_prev"
  prev.classList.add("fa", "fa-angle-right")
  prev.addEventListener("click", function () {
    page = currentPage - 1;
    search()
  })

  pagination.append(prev)

  for (var j = 1; j <= len; j++) {

    if (j > currentPage + 3) {
      var pageDeviderLatest = document.getElementById("a-devider")
      if (!pageDeviderLatest) {
        var aDevider = document.createElement("span")
        aDevider.innerText = "...";
        aDevider.id = "a-devider"
        pagination.append(aDevider)

        var latest = document.createElement("a")
        latest.innerText = len
        latest.onclick = function () {
          page = len;
          search()
        }
        pagination.append(latest)
      }
      continue
    }

    if (j < currentPage - 3) {
      var pageDeviderFirst = document.getElementById("b-devider")
      if (!pageDeviderFirst) {
        var first = document.createElement("a")
        first.innerText = 1
        first.onclick = function () {
          page = 1;
          search()
        }
        pagination.append(first)

        var bDevider = document.createElement("span")
        bDevider.innerText = "...";
        bDevider.id = "b-devider"
        pagination.append(bDevider)
      }
      continue
    }

    var a = document.createElement("a")
    a.id = "page_" + j
    a.innerText = j + ""
    if (j === currentPage) a.classList.add("active")
    a.onclick = function () {
      page = parseInt($(this).attr("id").replace("page_", ""));
      search()
    }
    pagination.append($(a))
  }


  var next = document.createElement("a")
  next.id = "page_next"
  next.classList.add("fa", "fa-angle-left")
  next.addEventListener("click", function () {
    page = currentPage + 1;
    search()
  })
  pagination.append(next)


  if (currentPage === len) {
    next.classList.remove("active")
  } else {
    next.classList.add("active")
  }

  if (currentPage === 1 || currentPage === 0) {
    prev.classList.remove("active")
  } else {
    prev.classList.add("active")
  }

}

function isRecycleBinMode() {
  var path = (window.location.href).trim().replace(" ", "");
  return path.includes("recycle-bin=true") || path.includes("recycle-bin=1");
}

function setupActions() {
  var actions = $("td.actions");
  for (var i = 0; i < actions.length; i++) {
    var action = actions[i];
    var name = action.getAttribute("data-name");
    var route = action.getAttribute("data-route");
    var id = action.getAttribute("data-id");

    var parameters = action.getAttribute("data-parameters");
    if (parameters) {
      parameters = JSON.parse(parameters);
    }

    if (action.hasAttribute("data-delete")) {
      var deleteTag;
      if (isRecycleBinMode()) {
        deleteTag = getRestoreRoute(name, route, id, parameters);
      } else {
        deleteTag = getDeleteRoute(name, route, id, parameters);
      }
      action.append(deleteTag)
    }
    if (action.hasAttribute("data-edit")) {
      var editTag = getEditRoute(name, route, id, parameters);
      action.append(editTag)
    }
  }
}


function getQueryParameters(routeData, routePrefix, isRecycleBin = false) {
  var count = 0;
  if (isRecycleBin) {
    routePrefix += "?recycle-bin=true";
    count++;
  }
  for (var rd in routeData) {
    if (!routePrefix.includes("?")) {
      routePrefix += "?" + rd + "=" + routeData[rd];
    } else {
      routePrefix += "&" + rd + "=" + routeData[rd];
    }
  }
  return routePrefix;
}

function getEditRoute(name, route, id, parameters) {
  var title = " ویرایش " + name;
  var a = document.createElement("a");
  a.setAttribute("data-toggle", "tooltip");
  a.setAttribute("data-placement", "bottom");
  a.setAttribute("title", title);
  a.classList.add("fa");
  a.classList.add("fa-edit");
  if (isRecycleBinMode())
    a.href = getQueryParameters(parameters, adminPrefix + "/" + route + "/" + id + "/edit", true);
  else
    a.href = getQueryParameters(parameters,  adminPrefix + "/" + route + "/" + id + "/edit", false);
  return a;
}

function getDeleteRoute(name, route, id, parameters) {

  var title = name + " به سطل زباله منتقل شود؟";
  var _route = getQueryParameters(parameters, adminPrefix + "/" + route + "/" + id, false);
  var span = document.createElement("span");
  span.setAttribute("data-toggle", "tooltip");
  span.setAttribute("data-placement", "bottom");
  span.setAttribute("title", "حذف " + name);
  span.classList.add("fa");
  span.classList.add("fa-trash");
  span.setAttribute("onclick", "deleteForm('" + _route + "','" + title + "',true)");
  return span;
}

function getRestoreRoute(name, route, id, parameters) {
  var title = name + " بازیابی شود؟";
  var _route = getQueryParameters(parameters, adminPrefix + "/" + route + "/" + id, false);
  var span = document.createElement("span");
  span.setAttribute("data-toggle", "tooltip");
  span.setAttribute("data-placement", "bottom");
  span.setAttribute("title", "بازیابی " + name);
  span.classList.add("fa");
  span.classList.add("fa-refresh");
  span.setAttribute("onclick", "deleteForm('" + _route + "','" + title + "',false)");
  return span;
}

function setNumericInput(querySelector) {
  new Cleave(querySelector, {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
}


function numberFormat(x) {
  x = x.toString();
  var pattern = /(-?\d+)(\d{3})/;
  while (pattern.test(x))
    x = x.replace(pattern, "$1,$2");
  return x;
}

var theme = readCookie("theme");

if (theme !== null) {
  var tTag = $("body");
  tTag.removeClass("bg-theme1");
  tTag.removeClass("bg-theme2");
  tTag.removeClass("bg-theme3");
  tTag.removeClass("bg-theme4");
  tTag.removeClass("bg-theme5");
  tTag.removeClass("bg-theme6");
  tTag.addClass(theme)
}

function changeTheme(theme) {
  createCookie("theme", theme, 30)
}

function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  } else var expires = "";
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name, "", -1);
}


function confirmMessage(message, callback) {
  Swal.fire({
    title: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'خیر',
    confirmButtonText: 'بله حذف شود'
  }).then((result) => {
    if (result.value) {
      callback()
    }
  })
}

document.addEventListener("DOMContentLoaded", function () {
  updateDepends()
})


function updateDepends() {

  const groups = document.getElementsByClassName("form-group")
  for (let j = 0; j < groups.length; j++) {
    let field = groups[j];
    // let hasDepend = $(field).data("depender") === 1
    let isDepender = $(field).data("has-depend") === 1

    if (isDepender) {

      let key = $(field).data("depend-key")
      let value = $(field).data("depend-value")


      if (value == "") {
        value = false
      }
      var selectedValue = $('input[name="' + key + '"]').val()

      checkDepend(selectedValue, value, field, 0, 0)
      selectedValue = $('select[name="' + key + '"]').val()
      checkDepend(selectedValue, value, field, 0, 0)

      setTimeout(function () {
        $('input[name="' + key + '"]').on("click", function () {
          var selectedValue = $(this).val();
          checkDepend(selectedValue, value, field)
        })

        $('select[name="' + key + '"]').on("click", function () {
          var selectedValue = $(this).val();
          checkDepend(selectedValue, value, field)
        })


      }, 50)
    }

  }
}

function checkDepend(selectedValue, value, field, slideUpTime = 400, slideDownTime = 400) {


  if (selectedValue === undefined) return
  if (selectedValue == 0) {
    selectedValue = false
  }
  console.log(field)

  if (selectedValue == value) {
    $(field).slideDown(slideDownTime)
  } else {
    $(field).slideUp(slideUpTime)
  }


}
























const recordCheckbox = $('.record-checkbox');
let lastRecordSelected = -1;
let shiftEnable = false

$(".dropdown-item.disabled").click(function () {
  const type = $(this).data('type')
  let checked = getChecked();

  if (checked.length === 0) {
    alert("هیچ موردی انتخاب نشده")
    return;
  }

  if (type === "DEFAULT_OPTION_DELETE") {

  } else if (type === "DEFAULT_OPTION_EDIT") {
    if (checked.length > 1) {
      alert("شما نمی توانید بیشتر از یک مورد را ویرایش کنید")
      return;
    }
  }


})

function getChecked() {

  let result = []
  for (let i = 0; i < recordCheckbox.length; i++) {
    let record = $(recordCheckbox[i])

    if (record.is(":checked")) {
      result.push(record.data('id'))
    }
  }
  return result;
}


recordCheckbox.click(function (event) {
  let currentSelected = $(this).data('row')
  if (lastRecordSelected < 0) {
    lastRecordSelected = currentSelected
    return;
  }

  if (!shiftEnable) {
    return;
  }

  let check = $(this).is(':checked')

  if (currentSelected > lastRecordSelected) {
    for (let i = 0; i < recordCheckbox.length; i++) {
      let record = $(recordCheckbox[i])
      if (record.data('row') >= lastRecordSelected && record.data('row') <= currentSelected) {
        record.prop('checked', check);
      }
    }
  } else {
    for (let i = 0; i < recordCheckbox.length; i++) {
      let record = $(recordCheckbox[i])
      if (record.data('row') <= lastRecordSelected && record.data('row') >= currentSelected) {
        record.prop('checked', check);
      }
    }
  }


  lastRecordSelected = -1;
})

document.addEventListener("DOMContentLoaded",function () {
  $(document).on('keyup keydown', function (e) {
    shiftEnable = e.shiftKey
  });


  $("#save-button").click(function () {
    $("#main-form").submit();
  })
})
