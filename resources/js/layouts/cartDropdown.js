try {
  let hovered = false;
  let cartCaret = document.getElementById("caret-cart")

  let headerCartIcon = document.getElementById("header-cart-icon")
  headerCartIcon.onmouseover = () => {
    let container = document.getElementById("header-cart-items")
    hovered = true
    container.classList.add("active")
    cartCaret.classList.add("active")
  }

  headerCartIcon.onmouseleave = () => {
    let container = document.getElementById("header-cart-items")
    setTimeout(function () {
      if (!hovered) {
        container.classList.remove("active")
        cartCaret.classList.remove("active")
      }
    }, 300)
    hovered = false
  }

  let headerCartItems = document.getElementById("header-cart-items")
  headerCartItems.onmouseover = () => {
    hovered = true
    headerCartItems.classList.add("active")
    cartCaret.classList.add("active")
  }

  headerCartItems.onmouseleave = () => {
    setTimeout(function () {
      if (!hovered) {
        headerCartItems.classList.remove("active")
        cartCaret.classList.remove("active")
      }
    }, 300)
    hovered = false

  }

} catch (e) {

}
