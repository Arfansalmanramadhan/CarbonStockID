document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("form");

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah form reload page

        // Mengambil nilai input dari form
        const username = document.getElementById("text").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("password").value;

        // Membuat objek data untuk dikirim
        const loginData = {
            username: username,
            email: email,
            password: password,
            confirmPassword: confirmPassword,
        };

        // Mengirim request POST menggunakan fetch
        fetch("http://127.0.0.1:8000/api/registasi", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(loginData),
        })
            .then((response) => response.json())
            .then((data) => {
                // Cek response dari server
                if (data.success) {
                    // Redirect ke dashboard jika login berhasil
                    window.location.href = "dashboard.html";
                } else {
                    // Tampilkan pesan error jika gagal
                    alert("Login gagal: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
