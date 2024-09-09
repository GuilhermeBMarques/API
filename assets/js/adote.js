document.addEventListener("DOMContentLoaded", function () {
  var search = document.getElementById("pesquisar");

  // Adiciona um evento de 'keydown' para o campo de pesquisa
  search.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      searchData();
    }
  });

  // Função para alterar a URL
  function searchData() {
    var query = search.value;
    window.location.href = "adote.php?search=" + encodeURIComponent(query);
  }

  // Adiciona evento ao botão de pesquisa
  document
    .querySelector(".box-search button")
    .addEventListener("click", function () {
      event.preventDefault();
      searchData();
    });
});
