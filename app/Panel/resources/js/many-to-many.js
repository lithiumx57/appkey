const {showToast} = require("./helpers");
document.addEventListener("DOMContentLoaded",function (){

  $('.btn.btn-primary.show-dialog').unbind()
  $('.btn.btn-primary.show-dialog').click(function () {
    let id = $(this).data('record-id')
    $('.dialog').removeClass('active')
    $("#dialog__" + id).addClass('active')
  })


  $('.dialog .zmdi.zmdi-close.close').unbind()
  $('.dialog .zmdi.zmdi-close.close').click(function () {
    $('.dialog').removeClass('active')
  })

  $(".confirm-dialog").unbind()
  $(".confirm-dialog").click(function () {
    let currentRecordId = $(this).data('id')
    let fillAble = $(this).data('fillable')
    let route=$(this).data('route')


    var mtm = $(".mtm_" + currentRecordId)
    var rows = [];

    for (var i = 0; i < mtm.length; i++) {
      var row = $(mtm[i])
      if (row.is(":checked")) {
        rows.push(row.data("id"))
      }
    }

    $.ajax({
      url: route + "/delete?type=mtm&t_id=" + currentRecordId,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      data: {
        _method: "DELETE",
        rows,
        relation: fillAble,
      },
    }).done(function (data) {
      if (data.status) {
        $('.dialog').removeClass('active')
        showToast(data.message)
        $("#dialog_" + fillAble + "_" + currentRecordId).removeClass("active")
      }
    })
  })


})

