// Variables globales
let conversationHistory = [];
let isWaitingForResponse = false;

// Función para añadir mensajes al chat
function addMessageToChat(message) {
  const chatContainer = document.getElementById("chat-messages");
  const messageDiv = document.createElement("div");
  messageDiv.className = `flex ${
    message.type === "user" ? "justify-end" : "justify-start"
  } mb-4`;

  const messageContent = `
        <div class="${
          message.type === "user"
            ? "bg-[#1979e6] text-white"
            : "bg-[#e7edf3] text-[#0e141b]"
        } rounded-xl px-4 py-2 max-w-[80%]">
            ${message.content}
            ${message.options ? createOptionsButtons(message.options) : ""}
        </div>
    `;

  messageDiv.innerHTML = messageContent;
  chatContainer.appendChild(messageDiv);
  chatContainer.scrollTop = chatContainer.scrollHeight;
}

// Función para crear botones de opciones
function createOptionsButtons(options) {
  return `
        <div class="flex flex-col gap-2 mt-3">
            ${options
              .map(
                (option) => `
                <button 
                    onclick="handleUserInput('${option}')"
                    class="text-left px-3 py-2 rounded-lg bg-white text-[#1979e6] text-sm hover:bg-[#1979e6] hover:text-white transition-colors">
                    ${option}
                </button>
            `
              )
              .join("")}
        </div>
    `;
}

// Función para abrir el modal del chat
function openChatModal() {
  document.getElementById("chat-modal").classList.remove("hidden");
  if (conversationHistory.length === 0) {
    addInitialMessage();
  }
}

// Función para cerrar el modal del chat
function closeChatModal() {
  document.getElementById("chat-modal").classList.add("hidden");
}

// Mensaje inicial cuando se abre el chat
function addInitialMessage() {
  const initialMessage = {
    type: "assistant",
    content:
      "¡Hola! Soy tu guía local virtual de Xàtiva. ¿Qué te gustaría explorar?",
    options: [
      "Quiero conocer la historia de Xàtiva",
      "Busco recomendaciones gastronómicas",
      "Me interesa la naturaleza de la zona",
      "Cuéntame sobre la cultura local",
    ],
  };
  addMessageToChat(initialMessage);
}

// Manejar la entrada del usuario
function handleUserInput(message) {
  if (isWaitingForResponse) return;

  addMessageToChat({
    type: "user",
    content: message,
  });

  isWaitingForResponse = true;
  showTypingIndicator();

  // Determinar la categoría basada en el mensaje
  let category = "";
  if (message.toLowerCase().includes("historia")) {
    category = "historia";
  } else if (
    message.toLowerCase().includes("gastronomía") ||
    message.toLowerCase().includes("gastronómicas")
  ) {
    category = "gastronomia";
  } else if (message.toLowerCase().includes("naturaleza")) {
    category = "naturaleza";
  } else if (message.toLowerCase().includes("cultura")) {
    category = "cultura";
  }

  // Hacer la consulta a WordPress
  fetch(`/wp-json/wp/v2/xativa_explore?explore_category=${category}`)
    .then((response) => response.json())
    .then((data) => {
      removeTypingIndicator();

      let responseMessage = {
        type: "assistant",
        content: formatResponseContent(data),
        options: [
          "Quiero saber más",
          "Buscar otra cosa",
          "Gracias, eso es todo",
        ],
      };

      addMessageToChat(responseMessage);
    })
    .catch((error) => {
      console.error("Error:", error);
      removeTypingIndicator();
      addMessageToChat({
        type: "assistant",
        content:
          "Lo siento, ha ocurrido un error. ¿Podrías intentarlo de nuevo?",
      });
    })
    .finally(() => {
      isWaitingForResponse = false;
    });
}

function formatResponseContent(data) {
  if (!data || !Array.isArray(data) || data.length === 0) {
    return "Lo siento, no encontré información específica sobre eso. ¿Te gustaría explorar otra área?";
  }

  let content = '<div class="space-y-4">';
  content += "<p>He encontrado estos lugares que podrían interesarte:</p>";
  content += '<div class="grid gap-3">';

  data.forEach((item) => {
    // Asegurarnos de que item y sus propiedades existen
    if (!item || !item.title || !item.excerpt) {
      return;
    }

    content += `
      <a href="${
        item.link || "#"
      }" class="block bg-white rounded-lg p-3 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex gap-3">
          ${
            item.featured_media_url
              ? `
              <div class="w-20 h-20 flex-shrink-0">
                <img src="${item.featured_media_url}" class="w-full h-full object-cover rounded-lg" alt="${item.title.rendered}">
              </div>
              `
              : ""
          }
          <div class="flex-1">
            <h4 class="font-bold text-[#1979e6]">${
              item.title.rendered || ""
            }</h4>
            <div class="text-sm text-[#4e7097] mt-1">${
              item.excerpt.rendered || ""
            }</div>
          </div>
        </div>
      </a>
    `;
  });

  content += "</div></div>";
  return content;
}

function showTypingIndicator() {
  const chatContainer = document.getElementById("chat-messages");
  const typingDiv = document.createElement("div");
  typingDiv.id = "typing-indicator";
  typingDiv.className = "flex justify-start mb-4";
  typingDiv.innerHTML = `
        <div class="bg-[#e7edf3] text-[#0e141b] rounded-xl px-4 py-2">
            <div class="flex gap-2">
                <div class="w-2 h-2 bg-[#4e7097] rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-[#4e7097] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-[#4e7097] rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>
        </div>
    `;
  chatContainer.appendChild(typingDiv);
}

function removeTypingIndicator() {
  const indicator = document.getElementById("typing-indicator");
  if (indicator) {
    indicator.remove();
  }
}
