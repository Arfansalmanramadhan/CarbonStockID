document.querySelector(".btn-simpan-perubahan").addEventListener("click", function (event) {
  event.preventDefault(); // Prevent form from submitting
  document.getElementById("popup").style.display = "flex"; // Show the popup
});

document.getElementById("popup-close").addEventListener("click", function () {
  document.getElementById("popup").style.display = "none"; // Hide the popup
});
