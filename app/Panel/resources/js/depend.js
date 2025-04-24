function getTags() {
  return $('[data-has-depend]');
}


getTags().addClass("hidden")


document.addEventListener("DEPENDS_RELOAD", () => {
  // init()
  // refresh()
});


init()
// refresh()

function init() {

  getTags().map((index, tag) => {
    tag = $(tag)
    let dependData = tag.data("depend-data")

    for (let key in dependData) {
      initSelect(key, dependData, tag)
      // initText(key, dependData, tag)
    }
  })
}


// function initText(key, dependData, tag) {
//   $("#" + key).on("keyup", (event) => {
//     if (dependData[key].toString() === event.target.value.toString()) {
//       tag.removeClass("hidden")
//     } else {
//       tag.addclass('hidden')
//     }
//     refresh()
//   })
// }


function initSelect(key, dependData, tag) {
  $("#" + key).unbind()
  $("#" + key).on("change", (event) => {


    let related = $("[data-depend-data]")
    for (let row of related) {
      let attributes = row.getAttribute("data-depend-data")
      attributes = JSON.parse(attributes)

      let target = attributes[key]

      if (!Array.isArray(target)) target = [target]


      console.log(tag.attr("data-depend-data"))




      for (let row2 of target) {

        if (row2===event.target.value){
          tag.removeClass("active")
        }

      }


    }


    // if (dependData[key].toString() === event.target.value.toString()) {
    //   tag.removeClass("hidden")
    // } else {
    //   tag.addclass('hidden')
    // }
    // refresh()
  })
}


// function refresh() {
//   let tags = getTags();
//   tags.map((index, tag) => {
//     tag = $(tag)
//     let dependData = tag.data("depend-data")
//
//     for (let key in dependData) {
//
//
//       let currentTag = $("#" + key);
//       let value = currentTag.val()
//
//
//       let result = dependData[key];
//
//       if (Array.isArray(result)) {
//         for (let row of result) {
//           buildSingle(row, tag, value, tags)
//         }
//       } else {
//         buildSingle(result, tag, value, tags)
//       }
//
//
//       // if (currentTag.hasClass("active")) {
//       //   console.log(currentTag)
//       //   tag.addclass("active")
//       // }
//
//
//     }
//   })
// }
//
// function buildSingle(dependData, tag, value, tags) {
//   if (dependData.toString() === value.toString()) {
//     tag.removeClass("hidden")
//   } else {
//     tag.addclass('hidden')
//     let depend = tag.data("name")
//     for (let i = 0; i < tags.length; i++) {
//       let tag = $(tags[i])
//       let data = tag.data("depend-data")
//       for (const [key, value] of Object.entries(data)) {
//         if (key === depend) {
//           setTimeout(function () {
//             tag.addclass("hidden")
//           }, 1)
//         }
//       }
//     }
//   }
// }
