function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  var draggedElement = document.getElementById(data);
  ev.target.appendChild(draggedElement);
}

document.addEventListener("DOMContentLoaded", function () {
  var menuIcon = document.querySelector(".menu-icon");
  var menuList = document.querySelector(".menu-list");

  menuIcon.addEventListener("click", function () {
    if (menuList.style.display === "block") {
      menuList.style.display = "none";
    } else {
      menuList.style.display = "block";
    }
  });
});
const form = document.querySelector("form");
(eField = form.querySelector(".email")),
  (eInput = eField.querySelector("input")),
  (pField = form.querySelector(".password")),
  (pInput = pField.querySelector("input"));

form.onsubmit = (e) => {
  e.preventDefault();

  eInput.value == "" ? eField.classList.add("shake", "error") : checkEmail();
  pInput.value == "" ? pField.classList.add("shake", "error") : checkPass();

  setTimeout(() => {
    eField.classList.remove("shake");
    pField.classList.remove("shake");
  }, 500);

  eInput.onkeyup = () => {
    checkEmail();
  };
  pInput.onkeyup = () => {
    checkPass();
  };

  function checkEmail() {
    let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!eInput.value.match(pattern)) {
      eField.classList.add("error");
      eField.classList.remove("valid");
      let errorTxt = eField.querySelector(".error-txt");

      eInput.value != ""
        ? (errorTxt.innerText = "Enter a valid email address")
        : (errorTxt.innerText = "Email can't be blank");
    } else {
      eField.classList.remove("error");
      eField.classList.add("valid");
    }
  }

  function checkPass() {
    if (pInput.value == "") {
      pField.classList.add("error");
      pField.classList.remove("valid");
    } else {
      pField.classList.remove("error");
      pField.classList.add("valid");
    }
  }

  if (
    !eField.classList.contains("error") &&
    !pField.classList.contains("error")
  ) {
    window.location.href = form.getAttribute("action");
  }
};
