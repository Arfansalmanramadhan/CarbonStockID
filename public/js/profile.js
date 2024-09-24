document.getElementById("uploadButton").addEventListener("click", function () {
  // Trigger file input click when the button is pressed
  document.getElementById("fileInput").click();
});

document.getElementById("fileInput").addEventListener("change", function (event) {
  const file = event.target.files[0]; // Get the selected file
  if (file) {
    if (file.size > 2 * 1024 * 1024) {
      // Check if file size is more than 2MB
      alert("File harus berukuran tidak lebih dari 2MB.");
      return;
    }

    const reader = new FileReader(); // Create a FileReader to read the image
    reader.onload = function (e) {
      const img = new Image();
      img.src = e.target.result;

      img.onload = function () {
        const width = img.width;
        const height = img.height;

        // Check if the image ratio is 1:1
        if (width !== height) {
          alert("File harus memiliki rasio 1:1.");
        } else {
          // Update the image preview if the file is valid
          const profileImage = document.querySelector('img[alt="User Photo"]');
          profileImage.src = e.target.result;
          profileImage.style.borderRadius = "8px"; // Add border-radius
        }
      };
    };

    reader.readAsDataURL(file); // Read the file as a data URL to display the image
  }
});

