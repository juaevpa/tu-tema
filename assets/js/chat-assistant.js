// Estado del chat
let conversationHistory = [];

// Función para alternar la visibilidad del chat
function toggleChatAssistant() {
  const chatAssistant = document.getElementById("chat-assistant");
  chatAssistant.classList.toggle("hidden");

  // Si el chat está visible y no hay historial, mostrar mensaje inicial
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
                    <p class="text-[#0e141b]">${message.content}</p>
                    ${
                      message.options
                        ? `
                        <div class="flex flex-col gap-2">
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
  chatMessages.scrollTop = chatMessages.scrollHeight;
  conversationHistory.push(message);
}

// Manejar selección del usuario
function handleUserSelection(selection) {
  // Añadir mensaje del usuario
  addMessageToChat({
    type: "user",
    content: selection,
  });

  // Simular respuesta del asistente
  setTimeout(() => {
    const response = getResponseForSelection(selection);
    addMessageToChat({
      type: "assistant",
      content: response,
      options: ["Tengo otra pregunta", "Gracias, eso es todo"],
    });
  }, 500);
}

// Obtener respuesta según la selección
function getResponseForSelection(selection) {
  const responses = {
    "Quiero conocer la historia de Xàtiva":
      "Xàtiva tiene una rica historia que se remonta a la época romana. Es especialmente conocida por su castillo medieval y por ser la cuna de la familia Borja. ¿Te gustaría que te recomiende lugares históricos específicos para visitar?",
    "Busco recomendaciones gastronómicas":
      "La gastronomía de Xàtiva es muy rica y variada. El arroz al horno es uno de nuestros platos más típicos, y tenemos excelentes restaurantes donde puedes probarlo. ¿Quieres que te recomiende algunos restaurantes?",
    "Me interesa la naturaleza de la zona":
      "La zona de Xàtiva está rodeada de hermosos paisajes naturales, perfectos para el ciclismo. Tenemos rutas para todos los niveles. ¿Te gustaría conocer algunas rutas específicas?",
    "Cuéntame sobre la cultura local":
      "Xàtiva tiene una vibrante escena cultural, con festivales, museos y tradiciones únicas. La Fira d'Agost es una de nuestras celebraciones más importantes. ¿Quieres saber más sobre algún aspecto en particular?",
    "Tengo otra pregunta": "¿Sobre qué te gustaría saber más?",
    "Gracias, eso es todo":
      "¡De nada! Si necesitas más información, no dudes en preguntarme. ¡Que disfrutes de tu visita a Xàtiva!",
  };

  return (
    responses[selection] ||
    "Lo siento, no entendí tu pregunta. ¿Podrías reformularla?"
  );
}
