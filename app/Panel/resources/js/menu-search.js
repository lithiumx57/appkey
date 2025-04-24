document.addEventListener("DOMContentLoaded", () => {
  $("#menu-search-input").on("keyup", function () {
    const keyword = $(this).val()
    search(keyword)
  })
})


search($("#menu-search-input").val())

function search(keyword){
  const menus = $(".menu-title")
  for (let i = 0; i < menus.length; i++) {
    const  row = $(menus[i])
    if (row.text().includes(keyword)) {
      row.parent().parent().show(0)
    } else {
      row.parent().parent().hide(0)
    }
  }
}
