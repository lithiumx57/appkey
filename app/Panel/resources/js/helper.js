let helper = document.getElementById("x-helpers")
import Swal from "sweetalert2";

export function getAdminPrefix() {
  let prefix = helper.getAttribute("data-admin-prefix")
  let adminPrefix;
  if (prefix.length > 0) adminPrefix = "/" + prefix + "/"
  else adminPrefix = "/"
  return adminPrefix
}

export function   showSwal(message) {
    Swal.fire({
      html: message,
      confirmButtonText: "تایید"
    });
}
