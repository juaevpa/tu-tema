// Estado del chat
let conversationHistory = [];
let currentContext = null;

// Función para alternar la visibilidad del chat
function toggleChatAssistant() {
  const chatAssistant = document.getElementById("chat-assistant");
  chatAssistant.classList.toggle("hidden");

  if (
    !chatAssistant.classList.contains("hidden") &&
    conversationHistory.length === 0
  ) {
    addInitialMessage();
  }
}

// Añadir mensaje inicial
function addInitialMessage() {
  const initialMessage = {
    type: "assistant",
    content:
      "¡Hola! Soy tu asistente virtual de Xàtiva. ¿En qué puedo ayudarte?",
    options: [
      "¿Dónde puedo comer?",
      "Necesito alojamiento",
      "Busco rutas ciclistas",
      "Lugares para visitar",
    ],
  };
  addMessageToChat(initialMessage);
}

// Función para procesar la consulta del usuario
async function processUserQuery(query) {
  try {
    const formData = new FormData();
    formData.append("action", "chat_assistant_search");
    formData.append("query", query);
    formData.append("context", JSON.stringify(currentContext));
    formData.append("nonce", chatAssistantNonce);

    const response = await fetch(ajaxurl, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      // Actualizar el contexto de la conversación
      currentContext = data.data.context || null;

      return {
        content: data.data.message,
        options: data.data.options,
      };
    }
  } catch (error) {
    console.error("Error:", error);
    return {
      content: "Lo siento, ha ocurrido un error. ¿Podrías intentarlo de nuevo?",
      options: ["Volver a empezar"],
    };
  }
}

// Formatear la respuesta
function formatResponse(results, query) {
  if (results.length === 0) {
    return {
      content:
        "Lo siento, no encontré información específica sobre eso. ¿Podrías reformular tu pregunta?",
      options: ["Tengo otra pregunta"],
    };
  }

  let response = `He encontrado algunos resultados que podrían interesarte sobre "${query}":\n\n`;

  results.forEach((result) => {
    response += `• ${result.title}\n${result.excerpt}\n[Ver más](${result.url})\n\n`;
  });

  return {
    content: response,
    options: ["Tengo otra pregunta", "Gracias, eso es todo"],
  };
}

// Manejar selección del usuario
async function handleUserSelection(selection) {
  addMessageToChat({
    type: "user",
    content: selection,
  });

  const response = await processUserQuery(selection);

  addMessageToChat({
    type: "assistant",
    content: response.content,
    options: response.options,
  });
}

// Añadir mensaje al chat
function addMessageToChat(message) {
  const chatMessages = document.getElementById("chat-messages");
  const messageElement = document.createElement("div");

  if (message.type === "assistant") {
    messageElement.className = "flex flex-col gap-4";
    messageElement.innerHTML = `
            <div class="flex gap-3 items-start">
                <div class="w-8 h-8 rounded-full bg-[#1979e6] flex items-center justify-center flex-shrink-0">
                    <i class="ph ph-user text-white"></i>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-[#0e141b] whitespace-pre-line" style="word-wrap: break-word;">${
                      message.content
                    }</div>
                    ${
                      message.options
                        ? `
                        <div class="flex flex-col gap-2 mt-3">
                            ${message.options
                              .map(
                                (option) => `
                                    <button onclick="handleUserSelection('${option}')" 
                                            class="text-left px-4 py-2 rounded-lg bg-[#e7edf3] text-[#0e141b] hover:bg-[#d0dbe7] transition-colors">
                                        ${option}
                                    </button>
                                `
                              )
                              .join("")}
                        </div>
                    `
                        : ""
                    }
                </div>
            </div>
        `;
  } else {
    messageElement.className = "flex justify-end";
    messageElement.innerHTML = `
            <div class="max-w-[80%] rounded-lg bg-[#1979e6] px-4 py-2 text-white">
                ${message.content}
            </div>
        `;
  }

  chatMessages.appendChild(messageElement);

  // Hacer que los enlaces sean clicables
  messageElement.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      window.location.href = link.href;
    });
  });

  chatMessages.scrollTop = chatMessages.scrollHeight;
  conversationHistory.push(message);
}
