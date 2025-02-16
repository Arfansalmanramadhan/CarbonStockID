
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
  var button = this.getBoundingClientRect(); // Dapatkan posisi tombol

  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    // Posisi dropdown berdasarkan tombol
    dropdown.style.top = button.bottom + window.scrollY + "px";
    dropdown.style.left = button.left + "px";
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
});

// Fungsi untuk memperbarui posisi saat window diresize
window.addEventListener("resize", function () {
  var dropdown = document.getElementById("dropdownPlotArea");
  var button = document.querySelector(".btn-plot-area").getBoundingClientRect();

  if (dropdown.style.display === "block") {
    dropdown.style.top = button.bottom + window.scrollY + "px";
    dropdown.style.left = button.left + "px";
  }
});

// Fungsi untuk mengubah teks pada tombol Plot Area
function updatePlotAreaText(newText) {
  var plotAreaSpan = document.querySelector(".btn-plot-area span");
  plotAreaSpan.textContent = newText;
}

// document.querySelector('li:contains("Sub Plot A")').addEventListener("click", function () {
//   const currentContent = document.getElementById("currentContent");
//   const subPlotAContent = document.getElementById("subPlotAContent");

//   // Slide out current content
//   currentContent.classList.add("slide-out-left");

//   // When the slide-out animation is done
//   currentContent.addEventListener(
//     "animationend",
//     function () {
//       // Hide current content and reset animation
//       currentContent.style.display = "none";
//       currentContent.classList.remove("slide-out-left");

//       // Show Sub Plot A content and apply slide-in-right animation
//       subPlotAContent.style.display = "block";
//       subPlotAContent.classList.add("slide-in-right");

//       // Remove slide-in-right animation once it's done
//       subPlotAContent.addEventListener(
//         "animationend",
//         function () {
//           subPlotAContent.classList.remove("slide-in-right");
//         },
//         { once: true }
//       );
//     },
//     { once: true }
//   );
// });

document.addEventListener("DOMContentLoaded", function() {
  if (document.getElementById('myToast')) {
    document.querySelector('.btn-success').click();
  }
});


document.getElementById('submitButton').addEventListener('click', function() {
  if (!document.getElementById('myToast')) {
    document.getElementById('plotAreaForm').submit(); // Trigger form submission
  }
});




// // Fungsi umum untuk menangani animasi konten
// function handleContentTransition(oldContentId, newContentId, direction) {
//   // Ambil elemen konten lama dan konten baru berdasarkan ID
//   var oldContent = document.getElementById(oldContentId);
//   var newContent = document.getElementById(newContentId);

//   // Tentukan arah animasi berdasarkan parameter
//   var slideOutClass = direction === "left" ? "slide-out-left" : "slide-out-right";
//   var slideInClass = direction === "left" ? "slide-in-right" : "slide-in-left";

//   // Tambahkan kelas untuk animasi slide out pada konten lama
//   oldContent.classList.add(slideOutClass);

//   // Tunggu hingga animasi slide-out selesai
//   setTimeout(function () {
//     // Sembunyikan konten lama setelah animasi selesai
//     oldContent.classList.add("hidden");
//     oldContent.classList.remove(slideOutClass);

//     // Tampilkan konten baru dengan menghapus kelas hidden dan menambahkan animasi slide-in
//     newContent.classList.remove("hidden");
//     newContent.classList.add(slideInClass);

//     // Hapus kelas animasi slide-in setelah animasi selesai
//     setTimeout(function () {
//       newContent.classList.remove(slideInClass);
//     }, 500); // Durasi animasi slide-in (0.5s)
//   }, 500); // Durasi animasi slide-out (0.5s)
// }

// // Event listener untuk tombol-tombol
// document.querySelector(".btn-success").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("currentContent", "newContent", "left");
//   updatePlotAreaText("Sub Plot A"); // Ubah teks Plot Area ketika pindah ke konten baru
// });

// document.getElementById("previousButton").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent", "currentContent", "right");
//   updatePlotAreaText("Plot Area"); // Kembalikan teks Plot Area ke awal saat pindah ke konten sebelumnya
// });

// document.querySelector(".btn-success-2").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent", "newContent2", "left");
//   updatePlotAreaText("Sub Plot B");
// });

// document.getElementById("previousButton2").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent2", "newContent", "right");
//   updatePlotAreaText("Sub Plot A");
// });

// document.querySelector(".btn-success-3").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent2", "newContent3", "left");
//   updatePlotAreaText("Sub Plot C");
// });

// document.getElementById("previousButton3").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent3", "newContent2", "right");
//   updatePlotAreaText("Sub Plot B");
// });

// document.querySelector(".btn-success-4").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent3", "newContent4", "left");
//   updatePlotAreaText("Sub Plot D");
// });

// document.getElementById("previousButton4").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent4", "newContent3", "right");
//   updatePlotAreaText("Sub Plot C");
// });

// document.querySelector(".btn-success-5").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent4", "newContent5", "left");
//   updatePlotAreaText("Hasil Hitung");
// });
// document.getElementById("previousButton5").addEventListener("click", function (e) {
//   e.preventDefault();
//   handleContentTransition("newContent5", "newContent4", "right");
//   updatePlotAreaText("Sub Plot D");
// });





// document.getElementById("plotA").addEventListener("click", function () {
//   handleContentTransition("currentContent", "newContent", "left");
//   updatePlotAreaText("Sub Plot A");
// });

// document.getElementById("plotB").addEventListener("click", function () {
//   handleContentTransition("newContent", "newContent2", "left");
//   updatePlotAreaText("Sub Plot B");
// });

// document.getElementById("plotC").addEventListener("click", function () {
//   handleContentTransition("newContent2", "newContent3", "left");
//   updatePlotAreaText("Sub Plot C");
// });

// document.getElementById("plotD").addEventListener("click", function () {
//   handleContentTransition("newContent3", "newContent4", "left");
//   updatePlotAreaText("Sub Plot D");
// });

// document.getElementById("hasilHitung").addEventListener("click", function () {
//   handleContentTransition("newContent4", "newContent5", "left");
//   updatePlotAreaText("Hasil Hitung");
// });

// MODAL

// document.querySelector(".btn-primary").addEventListener("click", function () {
//   alert("Data disimpan!");
// });

// // ---------------------- DropDown dataPlot -----------------------------
// function setupDropdown(toggleIconId, dropdownListId, inputFieldId) {
//   const toggleIcon = document.getElementById(toggleIconId);
//   const dropdownList = document.getElementById(dropdownListId);
//   const inputField = document.getElementById(inputFieldId);

//   toggleIcon.addEventListener("click", function () {
//     const isDropdownVisible = dropdownList.style.display === "block";

//     // Toggle visibility of the dropdown
//     dropdownList.style.display = isDropdownVisible ? "none" : "block";

//     // Change border-radius when dropdown is visible
//     inputField.style.borderRadius = isDropdownVisible ? "8px" : "8px 8px 0px 0px";
//   });
// }

// // Setup dropdowns
// setupDropdown("toggleDropdown", "dropdownList", "namaLokal");
// setupDropdown("toggleDropdown2", "dropdownList2", "namaLokal2");
// setupDropdown("toggleDropdown3", "dropdownList3", "namaLokal3");
// setupDropdown("toggleDropdown4", "dropdownList4", "namaLokal4");

// // Handle item click
// dropdownList.addEventListener("click", function (e) {
//   if (e.target.tagName === "LI") {
//     inputField.value = e.target.textContent; // Set input value to selected item
//     dropdownList.style.display = "none"; // Hide dropdown after selection
//     inputField.style.borderRadius = "8px"; // Reset border-radius after dropdown is hidden
//   }
// });

// function toggleImage(toggleIconId, inputFieldId) {
//   const img = document.getElementById(toggleIconId);
//   const input = document.getElementById(inputFieldId);

//   // Ubah gambar dan border secara bersamaan
//   if (img.src.includes("ChevronUp.svg")) {
//     // img.src = "assets/img/ChevronDownMini.svg";
//     // input.style.border = "1px solid var(--Primary-0, #4CAF4F)";
//     input.style.borderRadius = "8px 8px 0px 0px"; // Opsional: mengubah border-radius
//   } else {
//     // img.src = "assets/img/ChevronUp.svg";
//     // input.style.border = ""; // Mengembalikan border ke default
//     input.style.borderRadius = ""; // Mengembalikan border-radius ke default
//   }
// }

// // Setup multiple image toggles
// toggleImage("toggleDropdown", "namaLokal");
// toggleImage("toggleDropdown2", "namaLokal2");
// toggleImage("toggleDropdown3", "namaLokal3");
// toggleImage("toggleDropdown4", "namaLokal4");
// // ---------------------- DropDown dataPlot -----------------------------

// // dropdown data yang ditampilkan

// document.getElementById("toggleDropdownBanyakData").addEventListener("click", function () {
//   const dropdown = document.getElementById("dropdownListDataPlot");
//   dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
// });


// ----------------API MAP-------------------

// Masukkan token API dari Mapbox
mapboxgl.accessToken = "pk.eyJ1IjoicGVuZG9zYXRhdWJhdCIsImEiOiJjbTEzZzhiOGYxZDExMmtzZm1pNG01NDlvIn0.c_7si8BDiAd8JOwgfgKMkQ";

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
  enableHighAccuracy: true,
});

function successLocation(position) {
    console.log(position);
    setupMap([position.coords.longitude, position.coords.latitude]);

    // Mengisi field latitude dan longitude secara otomatis
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;

    // Memperbarui marker dengan koordinat terbaru
    if (marker) {
      marker.setLngLat([position.coords.longitude, position.coords.latitude]);
    }
  }

function errorLocation() {
  setupMap([106.8456, -6.2088]); // Default ke Jakarta jika gagal
}

function setupMap(center) {
  const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/streets-v11",
    center: center,
    zoom: 12,
  });

  // Menambahkan marker pada lokasi
  new mapboxgl.Marker().setLngLat(center).addTo(map);
}

// ---------- NO data -----------

// document.addEventListener("DOMContentLoaded", function () {
//   const noDataMessage = document.getElementById("noData");
//   const tableContainer = document.getElementById("tableContainer");
//   const tableBody = document.querySelector(".custom-table-pancang tbody");
//   const addDataBtn = document.getElementById("addData");
//   const saveDataBtn = document.querySelector(".btn-success-plot");

//   let dataEntries = []; // Array untuk menyimpan data baru

//   // Fungsi untuk menampilkan tabel jika ada data
//   function renderTable() {
//     if (dataEntries.length > 0) {
//       noDataMessage.style.display = "none"; // Sembunyikan pesan tidak ada data
//       tableContainer.style.display = "block"; // Tampilkan tabel
//     } else {
//       noDataMessage.style.display = "block"; // Tampilkan pesan tidak ada data
//       tableContainer.style.display = "none"; // Sembunyikan tabel
//     }
//   }

//   // Fungsi untuk menambah data ke tabel
//   function addDataToTable(newData) {
//     const newRow = document.createElement("tr");
//     newRow.innerHTML = `
//       <td>${dataEntries.length}</td>
//       <td>${newData.keliling} cm</td>
//       <td>${newData.diameter} cm</td>
//       <td>${newData.namaLokal}</td>
//       <td>${newData.namaIlmiah}</td>
//       <td class="hidden-column">${newData.kerapatan} gr/cm3</td>
//       <td class="hidden-column">${newData.biomassa} kg</td>
//       <td class="hidden-column">${newData.karbon} kg</td>
//       <td class="hidden-column">${newData.co2} kg</td>
//       <td class="hidden-column aksi-button">
//         <button class="edit-btn">
//           <img src="assets/img/PencilSquare.svg" alt="Edit" />
//         </button>
//         <button class="delete-btn">
//           <img src="assets/img/Trash.svg" alt="Delete" />
//         </button>
//       </td>
//     `;
//     tableBody.appendChild(newRow);
//   }

//   // Saat tombol Simpan ditekan
//   saveDataBtn.addEventListener("click", function () {
//     const newData = {
//       keliling: document.getElementById("keliling").value,
//       diameter: document.getElementById("diameter").value,
//       namaLokal: document.getElementById("namaLokal").value,
//       namaIlmiah: document.getElementById("namaIlmiah").value,
//       kerapatan: document.getElementById("kerapatanKayu").value,
//       biomassa: "xx", // Isi sesuai kalkulasi
//       karbon: "xx", // Isi sesuai kalkulasi
//       co2: "xx", // Isi sesuai kalkulasi
//     };

//     dataEntries.push(newData); // Tambah data baru ke array
//     addDataToTable(newData); // Tambah data ke tabel
//     renderTable(); // Render tabel jika ada data

//     // Reset form setelah data disimpan
//     document.querySelector("form").reset();
//   });

//   // Inisialisasi pertama kali
//   renderTable(); // Tampilkan pesan tidak ada data
// });
