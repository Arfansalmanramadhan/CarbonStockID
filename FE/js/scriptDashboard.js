document.addEventListener("DOMContentLoaded", (event) => {
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebar = document.getElementById("sidebar");

  sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("hidden");
  });

  // Existing Chart.js code...
  const ctx1 = document.getElementById("chart1").getContext("2d");
  const chart1 = new Chart(ctx1, {
    type: "bar",
    data: {
      labels: ["2024", "2025"],
      datasets: [
        {
          label: "Ton C / Ha",
          data: [2761.15, 6902.875],
          backgroundColor: ["#28a745", "#28a745"],
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  const ctx2 = document.getElementById("chart2").getContext("2d");
  const chart2 = new Chart(ctx2, {
    type: "bar",
    data: {
      labels: ["2024", "2025"],
      datasets: [
        {
          label: "Ton C / Ha",
          data: [2500.75, 7801.25],
          backgroundColor: ["#28a745", "#28a745"],
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  const ctx3 = document.getElementById("chart3").getContext("2d");
  const chart3 = new Chart(ctx3, {
    type: "bar",
    data: {
      labels: ["2024", "2025"],
      datasets: [
        {
          label: "Ton C / Ha",
          data: [1892.27, 5221.985],
          backgroundColor: ["#28a745", "#28a745"],
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
