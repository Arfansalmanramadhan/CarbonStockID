document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.querySelector("form");

  loginForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Mencegah halaman direload

    // Mengambil nilai input dari form
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // Validasi password
    if (password !== confirmPassword) {
      alert("Password dan Konfirmasi Password tidak sama!");
      return;
    }

    // Membuat objek data untuk dikirim
    const registrationData = {
      username: name, // Sesuaikan key dengan API
      email: email,
      password: password,
      password: password,
    };

    // Mengirim request POST menggunakan fetch
    fetch("http://127.0.0.1:8000/api/registasi", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(registrationData),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Registrasi gagal, periksa kembali data yang Anda masukkan.");
        }
        return response.json();
      })
      .then((data) => {
        // Cek response dari server
        if (data.success) {
          // Redirect ke dashboard jika registrasi berhasil
          window.location.href = "dashboard.html";
        } else {
          // Tampilkan pesan error jika gagal
          alert("Registrasi gagal: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Terjadi kesalahan, coba lagi.");
      });
  });
});
