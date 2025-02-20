document.addEventListener("DOMContentLoaded", function () {
  let submitBtn = document.querySelector("button[name='send']");
  submitBtn.disabled = true;
  let errors = {};

  function validateInput(input) {
    let fieldName = input.name;
    let value = input.value.trim();
    let errorMsg = "";

    if (
      input.nextElementSibling &&
      input.nextElementSibling.classList.contains("text-danger")
    ) {
      input.nextElementSibling.remove();
    }

    // Required field validation
    if (value === "") {
      errorMsg = "This field is required";
    }

    // Email validation
    if (fieldName === "email" && value !== "") {
      let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(value)) {
        errorMsg = "Please enter a valid email address";
      }
    }

    // Password validation (min 6 characters, at least one number and one special character)
    if (fieldName === "password" && value !== "") {
      let passwordPattern =
        /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
      if (!passwordPattern.test(value)) {
        errorMsg =
          "Password must be at least 6 characters, with one number and one special character";
      }
    }

    // Extension number validation (only numbers allowed)
    if (fieldName === "ext" && value !== "") {
      if (isNaN(value) || parseInt(value) <= 0) {
        errorMsg = "Extension must be a positive number";
      }
    }

    // Profile picture validation (file type and size)
    if (fieldName === "img") {
      let file = input.files[0];
      if (file) {
        let allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        let maxSize = 2 * 1024 * 1024; // 2MB

        if (!allowedTypes.includes(file.type)) {
          errorMsg = "Only JPG, PNG, and GIF files are allowed";
        } else if (file.size > maxSize) {
          errorMsg = "File size must not exceed 2MB";
        }
      }
    }

    // Display error message
    if (errorMsg !== "") {
      showError(input, errorMsg, fieldName);
    } else {
      delete errors[fieldName];
    }

    checkFormValidity();
  }

  function showError(input, message, fieldName) {
    let errorElement = document.createElement("p");
    errorElement.innerText = message;
    errorElement.className = "text-danger p-0 txt-sm";
    input.after(errorElement);
    errors[fieldName] = message;
  }

  function checkFormValidity() {
    let hasError = Object.keys(errors).length > 0;
    submitBtn.disabled = hasError;
  }

  document.querySelectorAll("input").forEach((input) => {
    input.addEventListener("blur", function () {
      validateInput(this);
    });

    input.addEventListener("input", function () {
      validateInput(this);
    });
  });

  document.querySelectorAll("input").forEach((input) => {
    validateInput(input);
  });
});
