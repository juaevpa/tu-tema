document.addEventListener("DOMContentLoaded", function () {
  // Verificar si existe el contenedor del mapa
  const mapContainer = document.getElementById("map-container");
  if (!mapContainer) return;

  // Inicializar el mapa
  const map = L.map("map-container").setView(
    [xativaMaps.defaultLat, xativaMaps.defaultLng],
    xativaMaps.defaultZoom
  );

  // Añadir capa de OpenStreetMap
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
  }).addTo(map);

  // Buscar todos los marcadores de la página
  const markers = document.querySelectorAll("[data-lat][data-lng]");
  markers.forEach((marker) => {
    const lat = parseFloat(marker.dataset.lat);
    const lng = parseFloat(marker.dataset.lng);
    const title = marker.dataset.title || "";
    const url = marker.dataset.url || "";

    if (lat && lng) {
      const mapMarker = L.marker([lat, lng]).addTo(map);

      if (title || url) {
        const popupContent = `
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-2">${title}</h3>
                        ${
                          url
                            ? `
                            <a href="${url}" 
                               class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
                                Ver detalles
                            </a>
                        `
                            : ""
                        }
                    </div>
                `;
        mapMarker.bindPopup(popupContent);
      }
    }
  });
});
