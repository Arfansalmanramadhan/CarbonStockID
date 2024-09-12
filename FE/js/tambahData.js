// Profile pop up

document.getElementById("userIcon").addEventListener("click", function () {
  var dropdown = document.getElementById("userProfileDropdown");
  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
});

// Close dropdown if clicked outside
window.addEventListener("click", function (e) {
  if (!document.getElementById("userIcon").contains(e.target) && !document.getElementById("userProfileDropdown").contains(e.target)) {
    document.getElementById("userProfileDropdown").style.display = "none";
  }
});

// Profile Pop up

//  dropdown plot area
document.querySelector(".btn-plot-area").addEventListener("click", function () {
  var dropdown = document.getElementById("dropdownPlotArea");
  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
});

// Fungsi umum untuk menangani animasi konten
function handleContentTransition(oldContentId, newContentId, direction) {
  // Ambil elemen konten lama dan konten baru berdasarkan ID
  var oldContent = document.getElementById(oldContentId);
  var newContent = document.getElementById(newContentId);

  // Tentukan arah animasi berdasarkan parameter
  var slideOutClass = direction === "left" ? "slide-out-left" : "slide-out-right";
  var slideInClass = direction === "left" ? "slide-in-right" : "slide-in-left";

  // Tambahkan kelas untuk animasi slide out pada konten lama
  oldContent.classList.add(slideOutClass);

  // Tunggu hingga animasi slide-out selesai
  setTimeout(function () {
    // Sembunyikan konten lama setelah animasi selesai
    oldContent.classList.add("hidden");
    oldContent.classList.remove(slideOutClass);

    // Tampilkan konten baru dengan menghapus kelas hidden dan menambahkan animasi slide-in
    newContent.classList.remove("hidden");
    newContent.classList.add(slideInClass);

    // Hapus kelas animasi slide-in setelah animasi selesai
    setTimeout(function () {
      newContent.classList.remove(slideInClass);
    }, 500); // Durasi animasi slide-in (0.5s)
  }, 500); // Durasi animasi slide-out (0.5s)
}

// Event listener untuk tombol-tombol
document.querySelector(".btn-success").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("currentContent", "newContent", "left");
});

document.getElementById("previousButton").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent", "currentContent", "right");
});

document.querySelector(".btn-success-2").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent", "newContent2", "left");
});

document.getElementById("previousButton2").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent2", "newContent", "right");
});

document.querySelector(".btn-success-3").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent2", "newContent3", "left");
});

document.getElementById("previousButton3").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent3", "newContent2", "right");
});

document.querySelector(".btn-success-4").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent3", "newContent4", "left");
});

// MODAL

document.querySelector(".btn-primary").addEventListener("click", function () {
  alert("Data disimpan!");
});

// DropDown
const toggleIcon = document.getElementById("toggleDropdown");
const dropdownList = document.getElementById("dropdownList");
const inputField = document.getElementById("namaLokal");

toggleIcon.addEventListener("click", function () {
  const isDropdownVisible = dropdownList.style.display === "block";

  // Toggle visibility of the dropdown
  dropdownList.style.display = isDropdownVisible ? "none" : "block";

  // Change border-radius when dropdown is visible
  if (isDropdownVisible) {
    inputField.style.borderRadius = "8px"; // Reset to default when dropdown is hidden
  } else {
    inputField.style.borderRadius = "8px 8px 0px 0px"; // Apply new border-radius when dropdown is shown
  }
});

// Handle item click
dropdownList.addEventListener("click", function (e) {
  if (e.target.tagName === "LI") {
    inputField.value = e.target.textContent; // Set input value to selected item
    dropdownList.style.display = "none"; // Hide dropdown after selection
    inputField.style.borderRadius = "8px"; // Reset border-radius after dropdown is hidden
  }
});

function toggleImage() {
  const img = document.getElementById("toggleDropdown");
  const input = document.getElementById("namaLokal");

  // Ubah gambar dan border secara bersamaan
  if (img.src.includes("ChevronUp.svg")) {
    img.src = "assets/img/ChevronDownMini.svg";
    input.style.border = "1px solid var(--Primary-0, #4CAF4F)";
    input.style.borderRadius = "8px 8px 0px 0px"; // Opsional: mengubah border-radius
  } else {
    img.src = "assets/img/ChevronUp.svg";
    input.style.border = ""; // Mengembalikan border ke default
    input.style.borderRadius = ""; // Mengembalikan border-radius ke default
  }
}
