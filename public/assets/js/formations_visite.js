const previewBtn = document.getElementById("previewBtn");

// Toggle button bg-Color
previewBtn.addEventListener("click", function onClick(event) {
  const previewBtnColor = previewBtn.style.backgroundColor;

  previewBtnColor === "rgb(87, 204, 153)"
    ? (previewBtn.style.backgroundColor = "rgb(200, 249, 205)")
    : (previewBtn.style.backgroundColor = "rgb(87, 204, 153)");
});

function dropdown(target) {
  target.parentNode
    .querySelector(".preview-box")
    .classList.toggle("showPreview");
}
