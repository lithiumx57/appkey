let page = 1;
let delUrl = null

function closeMcDialog(name) {
  document.body.style.overflow = "auto"
  let dialogCover = document.getElementById("mc-dialog-cover-" + name)
  let dialog = document.getElementById("mc-dialog-" + name)
  dialog.classList.remove("active")
  dialogCover.classList.remove('active')

  setTimeout(function () {
    // dialogCover.classList.add('active')
    dialog.classList.remove('show')
    dialogCover.classList.remove('show')

  }, 280)
}

function addDialogMc(label, name) {
  if (document.getElementsByClassName("mc-dialog-cover").length > 0) {
    return;
  }


  let tag = `<div class="mc-dialog-cover" id="mc-dialog-cover-${name}">
      <div class="mc-dialog" id="mc-dialog-${name}">
        <div class="mc-dialog-header">
          <div>${label}</div>
          <div><i onclick="closeMcDialog('${name}')" class="fa fa-times"></i></div>
        </div>

        <div class="mc-dialog-body">
          <div class="mc-uploader" id="mc-uploader-${name}">

          </div>

          <div id="mc-list-container-${name}">
            <div class="mc-pagination" id="mc-pagination-${name}"></div>
            <div class="mc-list" id="mc-list-${name}"></div>
          </div>

        </div>

        <div class="mc-dialog-footer">
          footer
        </div>
      </div>
    </div>`
  $("body").append(tag)
}

function addPaginationMc(response, listPath, name, page) {

  let paginationContainer = document.getElementById("mc-pagination-" + name)
  paginationContainer.innerHTML = ""

  if (response.lastPage === 1) {
    return;
  }

  for (let i = 1; i <= response.lastPage; i++) {

    if (response.currentPage - 3 > i) {
      continue
    }

    if (response.currentPage + 3 < i) {
      continue
    }

    let span = document.createElement("span")
    if (response.currentPage == i) {
      span.classList.add("active")
    }
    span.classList.add("mc-pagination-item")
    span.addEventListener("click", function () {
      getDataMc(listPath, name, i)
    })
    span.innerText = i + ""
    paginationContainer.appendChild(span)
  }


  // let container = document.getElementById("mc-list-container-" + name)
  // container.appendChild(paginationContainer)
}

function createFormMc(route, name) {
  if (document.getElementById("form_" + name)) return;

  let form = document.createElement("form")
  form.setAttribute("action", route)
  form.setAttribute("method", "post")
  form.setAttribute("encType", "multipart/form-data")
  form.setAttribute("id", "form_" + name)

  let div = document.createElement("div")
  div.classList.add("needsclick", "dropzone")
  div.setAttribute("id", "document-dropzone" + name)

  form.appendChild(div)
  document.getElementById("mc-uploader-" + name).appendChild(form)
}


function runMediaChooser(label, name, deleteRoute, route, listPath) {
  page = 1;
  delUrl = "/" + deleteRoute;


  addDialogMc(label, name)
  createFormMc(route, name)
  getDataMc(listPath, name)

  document.getElementById("mc-dialog-cover-" + name).addEventListener("click", (event) => {
    if (event.target.getAttribute("id") === "mc-dialog-cover-" + name) {
      closeMcDialog(name)
    }
  })

  document.getElementById("mc-remove-" + name).addEventListener("click", function () {
    document.getElementById("image_" + name).setAttribute("src", "")
  })

  let csrf = document.getElementById("csrf").getAttribute("content")
  $("#document-dropzone" + name).dropzone({
    url: route,
    maxFiles: 2000,
    headers: {
      'X-CSRF-TOKEN': csrf,
    },
    success: function (file, response) {
      getDataMc(listPath, name, page)
    },
    removedfile: function (file) {
      getDataMc(listPath, name, page)
    },

  });
}

function getDataMc(listPath, name, page) {
  addSkeletonMc(name)

  $.ajax({
    url: listPath,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    data: {
      page
    },
    method: "POST",
  }).then(response => {
    addPaginationMc(response, listPath, name, page)
    attachToListMc(response, name, listPath)
  })
}

function addSkeletonMc(name) {
  let container = document.getElementById("mc-list-" + name)
  const addTag = function () {
    let thumbnail = document.createElement("div")
    thumbnail.classList.add("mc-thumbnail", "mc-list-row")
    container.appendChild(thumbnail)
  }

  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
  addTag()
}

function createTag(name, type, link) {
  let result = document.getElementById("image_" + name)
  if (result){
    result.remove()
  }

  if (type === "image") {
    result = document.createElement("img")
    result.setAttribute("src", link)
  } else if (type === "video") {
    result = document.createElement("video")
    result.setAttribute("src", link)
    result.setAttribute("controls", "on")
  }

  result.setAttribute("id", "image_" + name)

  return result;
}

function attachToListMc(response, name, listPath) {
  let container = document.getElementById("mc-list-" + name)

  container.innerHTML = ""

  response.records.map(row => {
    let mcListRow = document.createElement("div")
    mcListRow.classList.add("mc-list-row")

    let mcRowActions = document.createElement("div")
    mcRowActions.classList.add("mc-row-actions")
    mcListRow.appendChild(mcRowActions)

    let mcTrach = document.createElement("i")
    mcTrach.classList.add("fa", "fa-trash")
    mcRowActions.appendChild(mcTrach)


    let mcType = document.createElement("i")
    if (row.type === "image") {
      mcType.classList.add("fa", "fa-image")
    } else {
      mcType.classList.add("fa", "fa-film")
    }

    mcRowActions.appendChild(mcType)

    let mcEye = document.createElement("i")
    mcEye.classList.add("fa", "fa-eye")
    mcRowActions.appendChild(mcEye)

    let attachmentContainer = document.createElement("div")
    mcListRow.appendChild(attachmentContainer)


    let attachment

    if (row.type === "image") {
      attachment = document.createElement("img")
    } else {
      attachment = document.createElement("video")
      attachment.setAttribute("controls", "on")
    }

    attachment.classList.add("mc-row")
    attachment.setAttribute("src", row.link)
    attachmentContainer.appendChild(attachment)


    attachmentContainer.classList.add("mc-attachment-container")

    mcEye.addEventListener("click", function () {
      document.querySelectorAll(".mc-attachment-container").forEach(row => {
        row.classList.remove("active")
        row.classList.remove("animation")
      })
      attachmentContainer.classList.add("active")
      setTimeout(function () {
        attachmentContainer.classList.add("animation")
      }, 20)
    })


    attachmentContainer.addEventListener("click", function () {

      if (attachmentContainer.classList.contains("active")) {
        attachmentContainer.classList.remove("active")
        attachmentContainer.classList.remove("animation")
        return;
      }

      let tag = createTag(name, row.type, row.link)
      let mediaDisplay = document.getElementById("media-display")
      mediaDisplay.innerHTML = ""
      mediaDisplay.appendChild(tag)

      document.getElementById("mc_input_" + name).value = row.id
      closeMcDialog(name)
    })

    container.appendChild(mcListRow)


    mcTrach.addEventListener("click", function (event) {
      event.preventDefault()
      event.stopPropagation()
      let canDelete = confirm("مدیا حذف شود؟")
      if (canDelete) {
        $.ajax({
          url: delUrl,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          method: "POST",
          data: {
            id: row.id
          }
        }).done(function (response) {
          getDataMc(listPath, name, page)
        })
      }


    })
  })


}
