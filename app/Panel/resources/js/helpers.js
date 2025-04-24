const Swal = require('sweetalert2')



const Toast = Swal.mixin({
  toast: true,
  position: 'bottom-start',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

function showToast(title, icon = "success") {
  Toast.fire({
    icon, title
  })
}


function confirmMessage(message, cb) {
  Swal.fire({
    title: message,
    icon: 'error',
    confirmButtonText: 'بله',
    cancelButtonText: 'خیر',
    showCancelButton: true,
    showCloseButton: true
  }).then(result => {
    if (result.isConfirmed) {
      cb()
    }
  })
}


let toastHelper = document.getElementById("toast-helper")
let toastData = JSON.parse(toastHelper.getAttribute("data-toast"))
if (toastData.title) {
  showToast(toastData.title, toastData.kind)
}


function getChecked() {
  const recordCheckbox = $('.x-checkbox');
  let result = []
  for (let i = 0; i < recordCheckbox.length; i++) {
    let record = $(recordCheckbox[i])
    if (record.is(":checked")) {
      result.push(record.data('id'))
    }
  }
  return result;
}

function checkedLen() {
  return getChecked().length
}

module.exports = {
  getChecked,
  showToast,
  checkedLen,
  confirmMessage,
  getToken: function () {
    return {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    }
  }
}
