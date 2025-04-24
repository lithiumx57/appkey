const Swal = require("sweetalert2")
module.exports = {
  confirmMessage: ({message, onYesClicked = {}, confirmText = "بله حذف شود", cancelText = "خیر"}) => {
    Swal.fire({
      title: message,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: cancelText,
      confirmButtonText: confirmText
    }).then((result) => {
      if (result.value) {
        onYesClicked()
      }
    })
  }
}
