document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchdata");
  const rows = document.querySelectorAll(".user-row");

  searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(function (row) {
      const fullName = row
        .querySelector(".user-full-name")
        .textContent.toLowerCase();
      row.style.display = fullName.includes(searchTerm) ? "table-row" : "none";
    });
  });
});

function showDeleteConfirmation(userId) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#9a3b3b",
    cancelButtonColor: "dark",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "?deleteid=" + userId;
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchdata");
  const rows = document.querySelectorAll(".user-row");

  const dropdown = document.querySelector(".dropdown");
  const dropdownContent = document.querySelector(".dropdown-content");

  dropdown.addEventListener("click", function (event) {
    if (event.target.tagName === "A") {
      const selectedRole = event.target.getAttribute("data-role");
      filterRows(selectedRole);
    }
  });

  function filterRows(selectedRole) {
    rows.forEach(function (row) {
      if (
        selectedRole === "all" ||
        row.classList.contains("role-" + selectedRole)
      ) {
        row.style.display = "table-row";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(function (row) {
      const fullName = row
        .querySelector(".user-full-name")
        .textContent.toLowerCase();
      row.style.display = fullName.includes(searchTerm) ? "table-row" : "none";
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchdata");
  const rows = document.querySelectorAll(".user-row");

  const dropdown = document.querySelector(".dropdown");
  const dropdownContent = document.querySelector(".dropdown-content");

  dropdown.addEventListener("click", function (event) {
    if (event.target.tagName === "A") {
      const selectedRole = event.target.getAttribute("data-role");
      filterRows(selectedRole);
    }
  });

  function filterRows(selectedRole) {
    rows.forEach(function (row) {
      if (
        selectedRole === "all" ||
        row.classList.contains("role-" + selectedRole)
      ) {
        row.style.display = "table-row";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(function (row) {
      const fullName = row
        .querySelector(".user-full-name")
        .textContent.toLowerCase();
      row.style.display = fullName.includes(searchTerm) ? "table-row" : "none";
    });
  });
});
