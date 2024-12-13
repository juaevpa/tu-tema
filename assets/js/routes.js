document.addEventListener("DOMContentLoaded", function () {
  // Manejar los dropdowns de filtros
  const toggles = document.querySelectorAll(".filter-dropdown-toggle");

  toggles.forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const dropdown = this.nextElementSibling;
      dropdown.classList.toggle("hidden");
    });
  });

  // Cerrar dropdowns cuando se hace clic fuera
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".filter-dropdown-toggle")) {
      document.querySelectorAll(".filter-dropdown").forEach((dropdown) => {
        dropdown.classList.add("hidden");
      });
    }
  });

  // Manejar el botón de reset
  const resetButton = document.querySelector('button[type="reset"]');
  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = window.location.pathname;
    });
  }
});
