/**Drop Down Cart Icon */
$("ul.cart-items").removeClass("d-none");
$("ul.cart-items").slideUp(0);

$(".cart-icon").click(function () {
  $("ul.cart-items").slideToggle(150);
});
function handleOrderNowClick(event) {
  const currentPath = window.location.pathname;
  if (currentPath.includes("user-home.php")) {
    event.preventDefault();
    document.getElementById("products").scrollIntoView({ behavior: "smooth" });
  }
}
