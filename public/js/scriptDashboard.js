// // JavaScript for Sidebar Toggle and Page Content Switch
const sidebar = document.getElementById("sidebar");
const berandaContent = document.getElementById("beranda-content");
const dataPlotContent = document.getElementById("data-plot-content");
const sampahContent = document.getElementById("sampah-content");
const panduanContent = document.getElementById("panduan-content");
const prediksiContent = document.getElementById("prediksi-content");
const navItems = document.querySelectorAll(".nav-item");
// const dataPlotImage = document.querySelector("#data-plot-content img");
// const tableBody = document.querySelector(".custom-table tbody");
const showEntriesSelect = document.getElementById("show-entries");

const hamburger = document.querySelector("#toogle-btn");
const sidebarCondition = document.querySelector("#sidebar");

// Tambahkan class 'no-transition' saat pertama kali dimuat
document.addEventListener("DOMContentLoaded", function () {
    sidebarCondition.classList.add("no-transition"); // Nonaktifkan transisi saat halaman dimuat

    // Cek status sidebar dari localStorage
    if (localStorage.getItem("sidebarExpanded") === "true") {
        sidebarCondition.classList.add("expand");
    } else {
        sidebarCondition.classList.remove("expand");
    }

    // Hapus class 'no-transition' setelah halaman selesai dimuat
    setTimeout(() => {
        sidebarCondition.classList.remove("no-transition");
    }, 100);
});
document.addEventListener("DOMContentLoaded", function() {
    let tables = document.querySelectorAll(".paginated-table");

    tables.forEach((table) => {
        let rows = table.querySelectorAll(".data-row");
        let select = table.querySelector(".dataPerPage");
        let prevBtn = table.querySelector(".prevPage");
        let nextBtn = table.querySelector(".nextPage");
        let currentPageElem = table.querySelector(".currentPage");
        let totalDataElem = table.querySelector(".totalData");
        let fromElem = table.querySelector(".fromNumber");
        let toElem = table.querySelector(".toNumber");
        let tableRows = table.querySelectorAll(".tableBody tr");
        let totalPagesElem = table.querySelector(".totalPages");

        let totalData = tableRows.length;
        let currentPage = 1;
        let rowsPerPage = parseInt(select.value) || 5;
        let totalPages = Math.ceil(rows.length / rowsPerPage);

        function displayRows() {
            rows = table.querySelectorAll(".data-row");
            totalPages = Math.ceil(rows.length / rowsPerPage);

            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;

            let fromNumber = start + 1;
            let toNumber = Math.min(end, rows.length);

            totalPagesElem.textContent = totalPages;
            currentPageElem.textContent = currentPage;
            fromElem.textContent = fromNumber;
            toElem.textContent = toNumber;
            totalDataElem.textContent = rows.length;

            rows.forEach((row, index) => {
                row.style.display = index >= start && index < end ? "" : "none";
            });

            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
        }

        select.addEventListener("change", function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            displayRows();
        });

        prevBtn.addEventListener("click", function() {
            if (currentPage > 1) {
                currentPage--;
                displayRows();
            }
        });

        nextBtn.addEventListener("click", function() {
            if (currentPage < totalPages) {
                currentPage++;
                displayRows();
            }
        });

        displayRows();
    });
});
// Toggle sidebar dan simpan status
hamburger.addEventListener("click", function () {
    sidebarCondition.classList.toggle("expand");

    // Simpan status ke localStorage
    if (sidebarCondition.classList.contains("expand")) {
        localStorage.setItem("sidebarExpanded", "true");
    } else {
        localStorage.setItem("sidebarExpanded", "false");
    }
});

// // MODAL
// // Get modal element
// var modal = document.getElementById("deleteModal");

// // Get the button that opens the modal
// var btn = document.querySelector(".delete-btn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // Get the cancel and delete buttons
// var cancelBtn = document.getElementById("cancelBtn");
// var deleteBtn = document.getElementById("deleteBtn");

// // When the user clicks the button, open the modal
// btn.onclick = function () {
//   modal.style.display = "block";
// };

// // When the user clicks on <span> (x), close the modal
// span.onclick = function () {
//   modal.style.display = "none";
// };

// // When the user clicks on cancel button, close the modal
// cancelBtn.onclick = function () {
//   modal.style.display = "none";
// };

// // When the user clicks anywhere outside the modal, close it
// window.onclick = function (event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// };

// // When the user clicks delete button, handle the delete action
// deleteBtn.onclick = function () {
//   alert("Plot Area dihapus!"); // Replace this with the actual delete action
//   modal.style.display = "none";
// };

// // MODAL

// // Function to toggle the sidebar
// function toggleSidebar() {
//   sidebar.classList.toggle("collapsed");

//   if (sidebar.classList.contains("collapsed")) {
//     dataPlotImage.classList.add("img-fullscreen");
//     dataPlotImage.classList.remove("img-normal");
//   } else {
//     dataPlotImage.classList.remove("img-fullscreen");
//     dataPlotImage.classList.add("img-normal");
//   }
// }

// // Function to switch between contents and highlight active sidebar item
// function switchContent(target) {
//   // Hide all content
//   berandaContent.classList.remove("active");
//   dataPlotContent.classList.remove("active");
//   sampahContent.classList.remove("active");
//   panduanContent.classList.remove("active");
//   prediksiContent.classList.remove("active");

//   // Remove active class from all nav items
//   navItems.forEach((item) => {
//     item.querySelector(".nav-link").classList.remove("active");
//   });

//   // Show content based on target and highlight sidebar item
//   if (target === "beranda") {
//     berandaContent.classList.add("active");
//     document.querySelector('a[href="dashboard"]').classList.add("active");
//   } else if (target === "panduant") {
//     dataPlotContent.classList.add("active");
//     document.querySelector('a[href="panduan"]').classList.add("active");
//   } else if (target === "dataplot") {
//     sampahContent.classList.add("active");
//     document.querySelector('a[href="dataplot"]').classList.add("active");
//   } else if (target === "manajermenUser") {
//     panduanContent.classList.add("active");
//     document.querySelector('a[href="manajermenUser"]').classList.add("active");
//   } else if (target === "Sampah") {
//     prediksiContent.classList.add("active");
//     document.querySelector('a[href="Sampah"]').classList.add("active");
//   }
// }

// // Event listeners for navigation
// document.querySelector(".burger-button").addEventListener("click", toggleSidebar);
// document.querySelector('a[href="dashboard"]').addEventListener("click", () => switchContent("beranda"));
// document.querySelector('a[href="panduan"]').addEventListener("click", () => switchContent("data-plot"));
// document.querySelector('a[href="dataPlot"]').addEventListener("click", () => switchContent("sampah"));
// document.querySelector('a[href="manajermenUser"]').addEventListener("click", () => switchContent("panduan"));
// document.querySelector('a[href="Sampah"]').addEventListener("click", () => switchContent("prediksi"));

// // Function to update table rows based on selected value
// function updateTableRows(entries) {
//   // Get all rows from the table
// //   const allRows = Array.from(tableBody.querySelectorAll("tr"));

//   // Hide all rows initially
//   allRows.forEach((row, index) => {
//     row.style.display = "none";
//   });

//   // Show only the number of rows specified by the selected value
//   for (let i = 0; i < entries && i < allRows.length; i++) {
//     allRows[i].style.display = "table-row";
//   }

//   // Update the table footer text to reflect the number of entries displayed
//   const footerText = document.querySelector(".table-footer span");
//   footerText.textContent = `Menampilkan 1 sampai ${Math.min(entries, allRows.length)} dari ${allRows.length} data`;
// }

// // Event listener for change in select dropdown
// showEntriesSelect.addEventListener("change", function () {
//   const selectedValue = parseInt(this.value);
//   updateTableRows(selectedValue);
// });

// // Initial setup: Show 5 rows by default
// updateTableRows(5);

// Profile pop up
document.addEventListener('DOMContentLoaded', () => {
  // Ambil elemen tombol burger dan sidebar
  const burgerButton = document.querySelector('.burger-button');
  const sidebar = document.querySelector('.sidebar');
  console.log('Burger Button:', burgerButton);
  console.log('Sidebar:', sidebar);
  // Periksa apakah elemen tersebut ada di DOM
  if (burgerButton && sidebar) {
      burgerButton.addEventListener('click', () => {
          // Tambahkan atau hapus kelas 'show' untuk menampilkan/menghilangkan sidebar
          sidebar.classList.toggle('show');
      });
  }
});
document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.sidebar-link');

  // Pastikan tombol yang sesuai URL memiliki kelas 'active'
  buttons.forEach(button => {
      if (button.href === window.location.href) {
          button.classList.add('active');
      }
  });

  // Tambahkan event listener untuk mengubah status 'active' saat diklik
  buttons.forEach(button => {
      button.addEventListener('click', () => {
          // Hapus kelas 'active' dari semua tombol
          buttons.forEach(btn => btn.classList.remove('active'));

          // Tambahkan kelas 'active' ke tombol yang diklik
          button.classList.add('active');
      });
  });
});


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

// // Profile Pop up

// // chart

// document.addEventListener("DOMContentLoaded", function () {
//   var ctx = document.getElementById("carbonEmissionsChart").getContext("2d");

//   var data = [
//     { t: new Date(2022, 0, 1), o: 9200, h: 9600, l: 9000, c: 9400 },
//     { t: new Date(2023, 0, 1), o: 9400, h: 9700, l: 9200, c: 9600 },
//     { t: new Date(2024, 0, 1), o: 9600, h: 9800, l: 9300, c: 9500 },
//     { t: new Date(2025, 0, 1), o: 9500, h: 9700, l: 9200, c: 9400 },
//   ];

//   var chart = new Chart(ctx, {
//     type: "candlestick",
//     data: {
//       datasets: [
//         {
//           label: "Prediksi Emisi Karbon Indonesia",
//           data: data,
//         },
//       ],
//     },
//     options: {
//       scales: {
//         x: {
//           type: "time",
//           time: {
//             unit: "year",
//           },
//         },
//       },
//     },
//   });
// });
document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen tombol
    const pertama = document.getElementById("pertama");
    const kedua = document.getElementById("kedua");
    const ketiga = document.getElementById("ketiga");
    const keempat = document.getElementById("keempat");
    const kelima = document.getElementById("kelima");
    const keenam = document.getElementById("keenam");
    const ketujuh = document.getElementById("ketujuh");
    const kedelapan = document.getElementById("kedelapan");
    const kesebilan = document.getElementById("kesebilan");

    // Ambil elemen div konten
    const serasah = document.getElementById("serasah");
    const semai = document.getElementById("semai");
    const tumbuhanBawah = document.getElementById("tumbuhanBawah");
    const tanah = document.getElementById("tanah");
    const pancang = document.getElementById("pancang");
    const mangrove = document.getElementById("mangrove");
    const tiang = document.getElementById("tiang");
    const pohon = document.getElementById("pohon");
    const nekromas = document.getElementById("nekromas");

    // Fungsi untuk menyembunyikan semua div dan hanya menampilkan satu
    function tampilkanHanya(elemen) {
        serasah.style.display = "none";
        semai.style.display = "none";
        tumbuhanBawah.style.display = "none";
        tanah.style.display = "none";
        pancang.style.display = "none";
        tiang.style.display = "none";
        pohon.style.display = "none";
        nekromas.style.display = "none";

        // Tampilkan elemen yang dipilih
        elemen.style.display = "block";
    }

    // Fungsi untuk mengaktifkan tombol yang dipilih
    function setActiveButton(activeButton) {
        pertama.classList.remove("activee");
        kedua.classList.remove("activee");
        ketiga.classList.remove("activee");
        keempat.classList.remove("activee");
        kelima.classList.remove("activee");
        keenam.classList.remove("activee");
        ketujuh.classList.remove("activee");
        kedelapan.classList.remove("activee");

        activeButton.classList.add("activee");
    }

    // Event listener untuk tombol
    pertama.addEventListener("click", function() {
        tampilkanHanya(serasah);
        setActiveButton(pertama);
    });

    kedua.addEventListener("click", function() {
        tampilkanHanya(semai);
        setActiveButton(kedua);
    });

    ketiga.addEventListener("click", function() {
        tampilkanHanya(tumbuhanBawah);
        setActiveButton(ketiga);
    });
    keempat.addEventListener("click", function() {
        tampilkanHanya(pancang);
        setActiveButton(keempat);
    });
    kelima.addEventListener("click", function() {
        tampilkanHanya(tiang);
        setActiveButton(kelima);
    });
    keenam.addEventListener("click", function() {
        tampilkanHanya(pohon);
        setActiveButton(keenam);
    });
    ketujuh.addEventListener("click", function() {
        tampilkanHanya(nekromas);
        setActiveButton(ketujuh);
    });
    kedelapan.addEventListener("click", function() {
        tampilkanHanya(tanah);
        setActiveButton(kedelapan);
    });

    // Atur tampilan awal (menampilkan serasah)
    tampilkanHanya(serasah);
    setActiveButton(pertama);
});
