// JavaScript for Sidebar Toggle and Page Content Switch
const sidebar = document.getElementById("sidebar");
const berandaContent = document.getElementById("beranda-content");
const dataPlotContent = document.getElementById("data-plot-content");
const sampahContent = document.getElementById("sampah-content");
const panduanContent = document.getElementById("panduan-content");
const prediksiContent = document.getElementById("prediksi-content");
const navItems = document.querySelectorAll(".nav-item");
const dataPlotImage = document.querySelector("#data-plot-content img");
const tableBody = document.querySelector(".custom-table tbody");
const showEntriesSelect = document.getElementById("show-entries");

// MODAL
// Get modal element
var modal = document.getElementById("deleteModal");

// Get the button that opens the modal
var btn = document.querySelector(".delete-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the cancel and delete buttons
var cancelBtn = document.getElementById("cancelBtn");
var deleteBtn = document.getElementById("deleteBtn");

// When the user clicks the button, open the modal
btn.onclick = function () {
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks on cancel button, close the modal
cancelBtn.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// When the user clicks delete button, handle the delete action
deleteBtn.onclick = function () {
  alert("Plot Area dihapus!"); // Replace this with the actual delete action
  modal.style.display = "none";
};

// MODAL

// Function to toggle the sidebar
function toggleSidebar() {
  sidebar.classList.toggle("collapsed");

  if (sidebar.classList.contains("collapsed")) {
    dataPlotImage.classList.add("img-fullscreen");
    dataPlotImage.classList.remove("img-normal");
  } else {
    dataPlotImage.classList.remove("img-fullscreen");
    dataPlotImage.classList.add("img-normal");
  }
}

// Function to switch between contents and highlight active sidebar item
function switchContent(target) {
  // Hide all content
  berandaContent.classList.remove("active");
  dataPlotContent.classList.remove("active");
  sampahContent.classList.remove("active");
  panduanContent.classList.remove("active");
  prediksiContent.classList.remove("active");

  // Remove active class from all nav items
  navItems.forEach((item) => {
    item.querySelector(".nav-link").classList.remove("active");
  });

  // Show content based on target and highlight sidebar item
  if (target === "beranda") {
    berandaContent.classList.add("active");
    document.querySelector('a[href="#beranda"]').classList.add("active");
  } else if (target === "data-plot") {
    dataPlotContent.classList.add("active");
    document.querySelector('a[href="#data-plot"]').classList.add("active");
  } else if (target === "sampah") {
    sampahContent.classList.add("active");
    document.querySelector('a[href="#sampah"]').classList.add("active");
  } else if (target === "panduan") {
    panduanContent.classList.add("active");
    document.querySelector('a[href="#panduan"]').classList.add("active");
  } else if (target === "prediksi") {
    prediksiContent.classList.add("active");
    document.querySelector('a[href="#prediksi"]').classList.add("active");
  }
}

// Event listeners for navigation
document.querySelector(".burger-button").addEventListener("click", toggleSidebar);
document.querySelector('a[href="#beranda"]').addEventListener("click", () => switchContent("beranda"));
document.querySelector('a[href="#data-plot"]').addEventListener("click", () => switchContent("data-plot"));
document.querySelector('a[href="#sampah"]').addEventListener("click", () => switchContent("sampah"));
document.querySelector('a[href="#panduan"]').addEventListener("click", () => switchContent("panduan"));
document.querySelector('a[href="#prediksi"]').addEventListener("click", () => switchContent("prediksi"));

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

// chart

document.addEventListener("DOMContentLoaded", function () {
  var ctx = document.getElementById("carbonEmissionsChart").getContext("2d");

  var data = [
    { t: new Date(2022, 0, 1), o: 9200, h: 9600, l: 9000, c: 9400 },
    { t: new Date(2023, 0, 1), o: 9400, h: 9700, l: 9200, c: 9600 },
    { t: new Date(2024, 0, 1), o: 9600, h: 9800, l: 9300, c: 9500 },
    { t: new Date(2025, 0, 1), o: 9500, h: 9700, l: 9200, c: 9400 },
  ];

  var chart = new Chart(ctx, {
    type: "candlestick",
    data: {
      datasets: [
        {
          label: "Prediksi Emisi Karbon Indonesia",
          data: data,
        },
      ],
    },
    options: {
      scales: {
        x: {
          type: "time",
          time: {
            unit: "year",
          },
        },
      },
    },
  });
});
