//Info
function toggleInfo(id) {
  var info = document.getElementById(id + "-message");
  if (info.classList.contains("hidden")) {
    info.classList.remove("hidden");
  } else {
    info.classList.add("hidden");
  }
}

//Busca menu-opcoes
function scrollToSection(sectionId) {
  var section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({
      behavior: "smooth",
    });
  }
}

// Fecha a mensagem de alerta
function fechar() {
  var alerta = document.querySelector(".alerta");
  if (alerta) {
    alerta.style.display = "none";
  }
}
