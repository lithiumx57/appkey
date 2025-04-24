const _delete = require("./_delete");
const popup = require("./popup");
const {confirmMessage, showToast} = require("./../helpers");

module.exports = {
  actionHandler: function ({type, link, data}) {
    if (type === "DEFAULT_ACTION_DELETE") {
      _delete.init(link)
    } else if (type === "DEFAULT_ACTION_POPUP") {
      popup.showPopup(data)
    } else if (type === "DEFAULT_ACTION_DELETE_FOR_EVER") {
      _delete.deleteForEver(link)
    } else if (type === "DEFAULT_ACTION_RESTORE") {
      _delete.restore(link)
    }
  }
}
