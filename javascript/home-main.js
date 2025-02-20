let categoryList = $(".category-list");
categoryList.slideUp(0);
document.querySelector(".category-btn").addEventListener("click", function () {
  categoryList.slideToggle(200);
});
function displayAddProductMessage(id, message) {
  buttons = document.querySelectorAll(".product-card button");
  for (let index = 0; index < buttons.length; index++) {
    if (buttons[index].dataset.productId == id) {
      buttons[index].innerText = "✔" + " " + message;
      buttons[index].disabled = true;
      buttons[index]
        .closest(".product-card")
        .scrollIntoView({ behavior: "auto" });
      setTimeout(() => {
        buttons[index].innerText = "Add To Cart";
        buttons[index].disabled = false;
      }, 2000);
    }
  }
}
window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("category") || urlParams.has("search")) {
    document.getElementById("products").scrollIntoView({ behavior: "smooth" });
  }
  if (urlParams.has("product")) {
    if (urlParams.has("message")) {
      displayAddProductMessage(
        urlParams.get("product"),
        urlParams.get("message")
      );
    }
    urlParams.delete("product");
    urlParams.delete("message");
  }
  window.history.replaceState(
    null,
    "",
    window.location.pathname + "?" + urlParams.toString()
  );
};
