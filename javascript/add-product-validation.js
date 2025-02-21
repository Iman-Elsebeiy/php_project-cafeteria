let submitBtn = document.querySelector("button.add");
submitBtn.disabled = true;
let errors = {};

$("input").each(function () {
  let value = this.value.trim();
  if (value === "") {
    showError(this, "This field is required", this.name);
  } else {
    delete errors[this.name];
  }
});

$("input").on("blur input", function () {
  if (this.nextElementSibling) {
    this.nextElementSibling.remove();
  }

  let value = this.value.trim();
  let fieldName = this.name;

  if (value === "") {
    showError(this, "This field is required", fieldName);
  } else {
    delete errors[fieldName];
  }

  if (this.type === "number" && value !== "") {
    if (isNaN(value) || parseFloat(value) < 0) {
      showError(this, "Please enter a valid positive number", fieldName);
    } else {
      delete errors[fieldName];
    }
  }

  if (this.type === "text" && value !== "") {
    let textPattern = /^[A-Za-z\s]{3,}$/;
    if (!textPattern.test(value)) {
      showError(this, "Only letters & spaces (min 3 chars)", fieldName);
    } else {
      delete errors[fieldName];
    }
  }

  checkFormValidity();
});

function showError(input, message, fieldName) {
  let errorMsg = document.createElement("p");
  errorMsg.innerText = message;
  errorMsg.className = "text-danger p-0 txt-sm";
  input.after(errorMsg);
  errors[fieldName] = message;
}

function checkFormValidity() {
  let hasError = Object.keys(errors).length > 0;
  submitBtn.disabled = hasError;
}

checkFormValidity();
