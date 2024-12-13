document.addEventListener("DOMContentLoaded", function () {
  // Manejar los dropdowns de filtros
  const toggles = document.querySelectorAll(".filter-dropdown-toggle");
  const dropdowns = document.querySelectorAll(".filter-dropdown");

  // Función para cerrar todos los dropdowns
  function closeAllDropdowns() {
    dropdowns.forEach((dropdown) => {
      dropdown.classList.add("hidden");
    });
  }

  // Manejar clics en los toggles
  toggles.forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      const dropdown = this.nextElementSibling;
      const isHidden = dropdown.classList.contains("hidden");

      // Cerrar todos los dropdowns
      closeAllDropdowns();

      // Si estaba oculto, mostrarlo
      if (isHidden) {
        dropdown.classList.remove("hidden");
      }
    });
  });

  // Cerrar dropdowns cuando se hace clic fuera
  document.addEventListener("click", function (event) {
    if (
      !event.target.closest(".filter-dropdown") &&
      !event.target.closest(".filter-dropdown-toggle")
    ) {
      closeAllDropdowns();
    }
  });

  // Evitar que los clics dentro del dropdown cierren el dropdown
  dropdowns.forEach((dropdown) => {
    dropdown.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  });

  // Manejar el botón de reset
  const resetButton = document.querySelector('button[type="reset"]');
  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      // Desmarcar todos los checkboxes
      document
        .querySelectorAll('input[type="checkbox"]')
        .forEach((checkbox) => {
          checkbox.checked = false;
        });
      // Redireccionar a la página de rutas sin parámetros
      window.location.href = window.location.pathname;
    });
  }

  // Manejar el envío del formulario
  const filterForm = document.querySelector(".filter-form");
  if (filterForm) {
    filterForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Recoger todos los valores seleccionados
      const formData = new FormData(this);
      const params = new URLSearchParams();

      // Añadir solo los parámetros que tienen valores
      for (const [key, value] of formData.entries()) {
        if (value) {
          params.append(key, value);
        }
      }

      // Construir la URL con los parámetros
      const url = `${window.location.pathname}?${params.toString()}`;
      window.location.href = url;
    });
  }
});
