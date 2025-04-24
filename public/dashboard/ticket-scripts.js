window.onresize = function () {
  initChatHeight()
}

initChatHeight()

function initChatHeight() {
  // var height = window.innerHeight;
  // var chatHeight = height - 200;
  // var result = document.getElementById("chat-container")
  // result.style.height = chatHeight + "px"
}


function changeTicketType(key) {
  window.Livewire.emit("change-tickets-type", key)
}


window.Livewire.on("create-ticket-loaded", createTicketLoaded)
window.Livewire.on("reference-ticket-loaded", referenceTicketLoaded)


function createTextAreaForCreateTicket() {

  // var container = $("#text-area-container");
  // var text = container.data("text")
  //
  // var tag = '<div class="form-group" style="width: calc(99% + 5px);margin-top: 20px">\n' +
  //   '          <label for="ticket-description">متن تیکت</label>\n' +
  //   '          <textarea name="" id="ticket-description" class="form-control" cols="30" rows="3">' + text + '</textarea>\n' +
  //   '        </div>';
  //
  //
  // container.empty().append(tag)
}


function createTicket() {
  var departments = $("#department-select").val()
  var operators = $("#operator-select").val()
  var subject = $("#ticket-subject").val()
  var priority = $("#priority-select").val()
  var description = $("#ticket-description").val();
  window.Livewire.emit("ticket-create", departments, operators, subject, description, priority)
}

function referenceTicket() {
  var departments = $("#department-select2").val()
  var operators = $("#operator-select2").val()
  var subject = $("#ticket-subject2").val()
  var priority = $("#priority-select2").val()
  var description = $("#ticket-description2").val();
  window.Livewire.emit("confirm-reference", departments, operators, subject, description, priority)
}

function createTicketLoaded() {
  createTextAreaForCreateTicket()
  var departmentChange = $("#department-select")
  departmentChange.select2()
  $("#operator-select").select2()
  $("#priority-select").select2()
  // CKEDITOR.config.language = "fa"
  // var editor = CKEDITOR.replace("ticket-description", {})
  // CKEDITOR.instances["ticket-description"].setData(description);

  // $("#ticket-description").val(description)
  $("#ticket-subject").on("keyup", () => refreshTicketSubjectLength())
  refreshTicketSubjectLength()
  departmentChange.on("change", function () {
    var operators = $("#operator-select").val()

    window.Livewire.emit("ticket-department-change", $(this).val(), operators)
  })

}

function referenceTicketLoaded() {
  var departmentChange = $("#department-select2")
  departmentChange.select2()
  $("#operator-select2").select2()
  $("#priority-select2").select2()
  // CKEDITOR.config.language = "fa"
  // var editor = CKEDITOR.replace("ticket-description", {})
  // CKEDITOR.instances["ticket-description"].setData(description);

  // $("#ticket-description").val(description)
  $("#ticket-subject2").on("keyup", () => refreshTicketSubjectLength())
  refreshTicketSubjectLength()
  departmentChange.on("change", function () {
    var operators = $("#operator-select2").val()

    window.Livewire.emit("change-department-reference", $(this).val(), operators)
  })

}

function refreshTicketSubjectLength() {

  var tag = $("#ticket-subject")
  var length = tag.val().length
  if (length > 31) {
    tag.val(tag.val().substring(0, 30))
  }
  if (length > 30) {
    $("#ticket-subject-length").empty().append(0)
  } else {
    $("#ticket-subject-length").empty().append(30 - length)
  }
}


window.Livewire.on("ticket-index-loaded", function () {
  ticketIndexLoaded()
})

ticketIndexLoaded()

function ticketIndexLoaded() {

  var ticketSearchInput = $("#search-keyword")
  var ticketAnswerButton = $(".send-answer")

  ticketSearchInput.unbind()
  ticketAnswerButton.unbind()

  ticketSearchInput.on("keyup", function () {
    window.Livewire.emit("ticket-filter-search", $(this).val())
  })

  ticketAnswerButton.click(function () {
    sendAnswer()
  })

}


function sendAnswer() {
  window.Livewire.emit("ticket-answer")
}


function onTicketClicked(ticketId) {
  $(".ticket-item").removeClass("active")
  $("#ticket-" + ticketId).addClass("active")
  window.history.pushState("", "", "/tickets?ticket=" + ticketId + "&page=" + 1);
  window.Livewire.emit("ticket-selected", ticketId)
}


function deleteUserFromTickets(userId) {
  showConfirm("آیا از حذف کاربر مطمئنید ؟ ", function () {
    window.Livewire.emit("delete-user-from-tickets", userId)
  })
}


function changeTicketStatus(status) {
  showConfirm("آیا از تغییر وضعیت تیکت مطمئنید ؟ ", function () {
    window.Livewire.emit("confirm-change-ticket-status", status)
  })
}


window.Livewire.on("reload-ticket-display", function (ticketId) {
  onTicketClicked(ticketId)
  var result = document.getElementsByName("chat-content")
  var tag = null
  if (result.length > 0) {
    tag = result[0]
  } else {
    return;
  }
  tag.scrollTo(0, tag.scrollHeight);
})
