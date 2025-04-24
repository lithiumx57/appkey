const recordCheckbox = $('.x-checkbox');

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


let lastRecordSelected = -1;
let shiftEnable = false


recordCheckbox.click(function () {

  let checked = getChecked()
  if (checked.length > 0) {
    $(".dropdown-item.disabled").removeClass("disabled")
  }else{
    $(".dropdown-item[data-enable-check='1']").addClass("disabled")
  }

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




document.addEventListener("DOMContentLoaded",function (){
  $(document).on('keyup keydown', function (e) {
    shiftEnable = e.shiftKey
  });



  $("#save-button").click(function () {
    $("#main-form").submit();
  })
})




module.exports = {}
