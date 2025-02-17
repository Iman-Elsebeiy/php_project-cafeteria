let slide_image = [
  "../../app-images/h2.png",
  "../../app-images/h3.png",
  "../../app-images/h1.png",
];
let sliderConatiner = document.querySelector(".header-silde");
let counter = 0;

let bgInterval = setInterval(function () {
  sliderConatiner.classList.replace("visible", "hidden");
  setTimeout(() => {
    sliderConatiner.style.backgroundImage = `url(${slide_image[counter++]})`;
    sliderConatiner.classList.replace("hidden", "visible");
    if (counter >= slide_image.length) {
      counter = 0;
    }
  }, 1000);
}, 3000);
window.addEventListener("beforeunload", () => {
  clearInterval(bgInterval);
});
let categoryList = $(".category-list");
categoryList.slideUp(0);
document.querySelector(".category-btn").addEventListener("click", function () {
  categoryList.slideToggle(200);
});
window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("category") || urlParams.has("search")) {
    document.getElementById("products").scrollIntoView({ behavior: "smooth" });
  }
};
