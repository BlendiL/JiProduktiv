$(function () {});

function openModal() {
  document.getElementById("modal").style.display = "flex";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}

function openModal2() {
  document.getElementById("modal2").style.display = "flex";
}

function closeModal2() {
  document.getElementById("modal2").style.display = "none";
}

document.getElementById("searchForm").addEventListener("submit", function (e) {
  e.preventDefault();

  var searchInput = document.getElementById("search").value;

  // Krijimi i një kërkesë AJAX për të kërkuar perdoruesit nga baza e të dhënave
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "search.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Shfaq rezultatet e kërkimit në div-in "results"
      document.getElementById("results").innerHTML = xhr.responseText;
    }
  };
  xhr.send("search=" + searchInput);
});

// Skenari i mëparshëm për shtimin e perdoruesit mbetet i njëjtë

// Skripti JavaScript për lidhjen e ngjarjes së shtimit dhe heqjes së perdoruesit
document.getElementById("results").addEventListener("click", function (e) {
  if (e.target.classList.contains("add-user")) {
    // Merr ID e perdoruesit nga atributi data-id
    var userId = e.target.getAttribute("data-id");

    // Krijimi i një kërkesë AJAX për të shtuar perdoruesin në bazën e të dhënave
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "add_user.php?id=" + userId, true);
    xhr.send();

    // Përditëso faqen pa rifreskim për të rifreskuar rezultatet
    xhr.onload = function () {
      // Shfaq rezultatet e përditësuara në div-in "results"
      document.getElementById("results").innerHTML = xhr.responseText;
    };
  } else if (e.target.classList.contains("remove-user")) {
    // Merr ID e perdoruesit nga atributi data-id
    var userId = e.target.getAttribute("data-id");

    // Krijimi i një kërkesë AJAX për të hequr perdoruesin nga baza e të dhënave
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "remove_user.php?id=" + userId, true);
    xhr.send();

    // Përditëso faqen pa rifreskim për të rifreskuar rezultatet
    xhr.onload = function () {
      // Shfaq rezultatet e përditësuara në div-in "results"
      document.getElementById("results").innerHTML = xhr.responseText;
    };
  }
});

function shfaqDiv(numri) {
  // Fshij të gjitha divat
  for (let i = 1; i <= 3; i++) {
    document.getElementById("div" + i).style.display = "none";
  }

  // Shfaq divin e caktuar
  document.getElementById("div" + numri).style.display = "block";
}
