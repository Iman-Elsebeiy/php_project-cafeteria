/**Manage User Home Slider */
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
