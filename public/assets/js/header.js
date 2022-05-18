const btn = document.getElementById("nav-btn");
const slider = document.getElementById("slider");
const element = document.body;
const toggleLight = document.querySelectorAll(".light");

function dropdownMenu() {
  document.getElementById("dropdown").classList.toggle("show");
}

// Toggle light theme
slider.addEventListener("change", function () {
  toggleLight.forEach((el) => {
    el.classList.toggle("theme-dark");
  });
});

// Toggle button bg-Color
btn.addEventListener("click", function onClick(event) {
  const btnColor = btn.style.backgroundColor;

  btnColor === "rgb(199, 249, 204)"
    ? (btn.style.backgroundColor = "rgb(128, 237, 153)")
    : (btn.style.backgroundColor = "rgb(199, 249, 204)");
});
