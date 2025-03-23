document.getElementById("uploadButton").addEventListener("click", function () {
    // Trigger file input click when the button is pressed
    document.getElementById("fileInput").click();
  });

  document.getElementById("fileInput").addEventListener("change", function (event) {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
      if (file.size > 2 * 1024 * 1024) {
        alert("File harus berukuran tidak lebih dari 2MB.");
        event.target.value = ""; // Reset input file
        return;
      }

      const img = new Image();
      img.src = URL.createObjectURL(file); // Lebih cepat daripada FileReader()

      img.onload = function () {
        const width = img.width;
        const height = img.height;

        // Check if the image ratio is 1:1
        if (width !== height) {
          alert("File harus memiliki rasio 1:1.");
          event.target.value = ""; // Reset input file
        } else {
          // Update the image preview if the file is valid
          const profileImage = document.querySelector('img[alt="User Photo"]');
          profileImage.src = img.src;
          profileImage.style.borderRadius = "8px"; // Add border-radius
        }

        URL.revokeObjectURL(img.src); // Hapus URL setelah dipakai untuk menghemat memori
      };
    }
  });
