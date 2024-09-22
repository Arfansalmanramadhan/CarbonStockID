function toggleAnswer(element) {
  element.classList.toggle("active");

  // Mendapatkan parent section dari elemen yang di klik
  const section = document.getElementById("Pertanyaan");

  // Mendapatkan semua elemen pertanyaan
  const allQuestions = section.querySelectorAll(".card-pertanyaan");

  // Variabel untuk menghitung total tinggi yang dibutuhkan
  let totalHeight = 0;

  // Loop melalui semua pertanyaan untuk menghitung tinggi yang diperlukan
  allQuestions.forEach((question) => {
    // Jika elemen pertanyaan memiliki kelas 'active', tambahkan tinggi kontennya
    if (question.classList.contains("active")) {
      const body = question.querySelector(".pertanyaan-body");
      totalHeight += body.scrollHeight; // Menambah tinggi konten body
    }
    // Tambahkan tinggi setiap pertanyaan termasuk padding dan margin
    totalHeight += question.offsetHeight;
  });

  // Set height section ke total tinggi yang dihitung atau auto jika tidak ada yang aktif
  section.style.height = totalHeight ? `${totalHeight}px` : "auto";
}

const navbar = document.getElementsByTagName("nav")[0];
window.addEventListener("scroll", function () {
  if (this.window.scrollY > 1) {
    navbar.classList.replace("bg-transparent", "nav-color");
  } else if (this.window.scrollY <= 0) {
    navbar.classList.replace("nav-color", "bg-transparent");
  }
});
