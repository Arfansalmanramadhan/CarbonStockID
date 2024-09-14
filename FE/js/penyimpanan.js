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

document.getElementById("previousButton4").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent4", "newContent3", "right");
});

document.querySelector(".btn-success-5").addEventListener("click", function (e) {
  e.preventDefault();
  handleContentTransition("newContent4", "newContent5", "left");
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

const toggleIcon2 = document.getElementById("toggleDropdown2");
const dropdownList2 = document.getElementById("dropdownList2");
const inputField2 = document.getElementById("namaLokal2");

toggleIcon2.addEventListener("click", function () {
  const isDropdownVisible2 = dropdownList2.style.display === "block";

  // Toggle visibility of the dropdown
  dropdownList2.style.display = isDropdownVisible2 ? "none" : "block";

  // Change border-radius when dropdown is visible
  if (isDropdownVisible2) {
    inputField2.style.borderRadius = "8px"; // Reset to default when dropdown is hidden
  } else {
    inputField2.style.borderRadius = "8px 8px 0px 0px"; // Apply new border-radius when dropdown is shown
  }
});

const toggleIcon3 = document.getElementById("toggleDropdown3");
const dropdownList3 = document.getElementById("dropdownList3");
const inputField3 = document.getElementById("namaLokal3");

toggleIcon3.addEventListener("click", function () {
  const isDropdownVisible3 = dropdownList3.style.display === "block";

  // Toggle visibility of the dropdown
  dropdownList3.style.display = isDropdownVisible3 ? "none" : "block";

  // Change border-radius when dropdown is visible
  if (isDropdownVisible3) {
    inputField3.style.borderRadius = "8px"; // Reset to default when dropdown is hidden
  } else {
    inputField3.style.borderRadius = "8px 8px 0px 0px"; // Apply new border-radius when dropdown is shown
  }
});

const toggleIcon4 = document.getElementById("toggleDropdown4");
const dropdownList4 = document.getElementById("dropdownList4");
const inputField4 = document.getElementById("namaLokal4");

toggleIcon4.addEventListener("click", function () {
  const isDropdownVisible4 = dropdownList4.style.display === "block";

  // Toggle visibility of the dropdown
  dropdownList4.style.display = isDropdownVisible4 ? "none" : "block";

  // Change border-radius when dropdown is visible
  if (isDropdownVisible4) {
    inputField4.style.borderRadius = "8px"; // Reset to default when dropdown is hidden
  } else {
    inputField4.style.borderRadius = "8px 8px 0px 0px"; // Apply new border-radius when dropdown is shown
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

function toggleImage2() {
  const img2 = document.getElementById("toggleDropdown2");
  const input2 = document.getElementById("namaLokal2");

  // Ubah gambar dan border secara bersamaan
  if (img2.src.includes("ChevronUp.svg")) {
    img2.src = "assets/img/ChevronDownMini.svg";
    input2.style.border = "1px solid var(--Primary-0, #4CAF4F)";
    input2.style.borderRadius = "8px 8px 0px 0px"; // Opsional: mengubah border-radius
  } else {
    img2.src = "assets/img/ChevronUp.svg";
    input2.style.border = ""; // Mengembalikan border ke default
    input2.style.borderRadius = ""; // Mengembalikan border-radius ke default
  }
}

function toggleImage3() {
  const img3 = document.getElementById("toggleDropdown3");
  const input3 = document.getElementById("namaLokal3");

  // Ubah gambar dan border secara bersamaan
  if (img3.src.includes("ChevronUp.svg")) {
    img3.src = "assets/img/ChevronDownMini.svg";
    input3.style.border = "1px solid var(--Primary-0, #4CAF4F)";
    input3.style.borderRadius = "8px 8px 0px 0px"; // Opsional: mengubah border-radius
  } else {
    img3.src = "assets/img/ChevronUp.svg";
    input3.style.border = ""; // Mengembalikan border ke default
    input3.style.borderRadius = ""; // Mengembalikan border-radius ke default
  }
}

function toggleImage4() {
  const img4 = document.getElementById("toggleDropdown4");
  const input4 = document.getElementById("namaLokal4");

  // Ubah gambar dan border secara bersamaan
  if (img4.src.includes("ChevronUp.svg")) {
    img4.src = "assets/img/ChevronDownMini.svg";
    input4.style.border = "1px solid var(--Primary-0, #4CAF4F)";
    input4.style.borderRadius = "8px 8px 0px 0px"; // Opsional: mengubah border-radius
  } else {
    img4.src = "assets/img/ChevronUp.svg";
    input4.style.border = ""; // Mengembalikan border ke default
    input4.style.borderRadius = ""; // Mengembalikan border-radius ke default
  }
}

// dropdown data yang ditampilkan

document.getElementById("toggleDropdownBanyakData").addEventListener("click", function () {
  const dropdown = document.getElementById("dropdownListDataPlot");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

document.addEventListener("DOMContentLoaded", function () {
  const nekromasBtn = document.getElementById("nekromasBtn");
  const pohonBtn = document.getElementById("pohonBtn");
  const nekromasContent = document.getElementById("nekromasContent");
  const pohonContent = document.getElementById("pohonContent");

  // Fungsi untuk menampilkan konten Nekromas
  nekromasBtn.addEventListener("click", function () {
    nekromasContent.classList.add("activeD");
    pohonContent.classList.remove("activeD");
  });

  // Fungsi untuk menampilkan konten Pohon
  pohonBtn.addEventListener("click", function () {
    pohonContent.classList.add("activeD");
    nekromasContent.classList.remove("activeD");
  });

  // Tampilkan konten Pohon secara default
  pohonContent.classList.add("activeD");
});

// ----------------------

document.getElementById("nekromasBtn").addEventListener("click", function () {
  this.classList.add("active");
  document.getElementById("pohonBtn").classList.remove("active");
});

document.getElementById("pohonBtn").addEventListener("click", function () {
  this.classList.add("active");
  document.getElementById("nekromasBtn").classList.remove("active");
});
