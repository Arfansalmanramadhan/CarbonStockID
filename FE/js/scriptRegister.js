document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("form");

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah form reload page

        // Mengambil nilai input dari form
        const username = document.getElementById("username").value; // Perbaikan di sini
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword =
            document.getElementById("confirm-password").value; // Perbaikan di sini
            // console.log(username);
            // console.log(email);
            // console.log(password);

        // Membuat objek data untuk dikirim
        const loginData = {
            username: username,
            email: email,
            password: password,
            role_id: 1,
            // confirmPassword: confirmPassword,
        };

        // Mengirim request POST menggunakan fetch
        fetch("http://127.0.0.1:8000/api/registasi", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(loginData),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then((loginData) => {
                // Cek apakah response sukses
                if (loginData.success) {
                    window.location.href = "dashboard.html";
                } else {
                    alert("Login gagal: " + loginData.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
