/**Drop Down Cart Icon */
$("ul.cart-items").removeClass("d-none");
$("ul.cart-items").slideUp(0);

$(".cart-icon").click(function () {
  $("ul.cart-items").slideToggle(200);
});
