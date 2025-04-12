$(".toastfy").removeClass("d-none");
$(".toastfy").hide(0);
let category_list = $(".category-list li a").toArray();
function displayAddProductMessage() {
  $(".toastfy").show(500);
  setTimeout(() => {
    $(".toastfy").hide(500);
  }, 1000);
}
window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (
    urlParams.has("category") ||
    urlParams.has("search") ||
    urlParams.has("product") ||
    urlParams.has("cart_user_id")
  ) {
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
  for (let i = 0; i < category_list.length; i++) {
    if (category_list[i].dataset.categoryId == urlParams.get("category")) {
      $(".category-list li a").removeClass("active-category");
      category_list[i].classList.add("active-category");
      document
        .getElementById("products")
        .scrollIntoView({ behavior: "smooth" });
    }
  }
  window.history.replaceState(
    null,
    "",
    window.location.pathname + "?" + urlParams.toString()
  );
};
