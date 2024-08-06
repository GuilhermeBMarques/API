const cachorroForm = document.getElementById('cachorro-form');
const cachorroList = document.getElementById('cachorro-list');

function listCachorros() {
    fetch('http://localhost:3000/cachorro')
        .then(response => response.json())
        .then(data => {
            cachorroList.innerHTML = '';
            data.forEach(cachorro => {
                const li = document.createElement('li');
                const createImg = document.createElement('img');        
                const nameEl = document.createElement('h2');
                const racaEl = document.createElement('h5');
                const generoEl = document.createElement('p');
                const idadeEl = document.createElement('p');
                const localizacaoEl = document.createElement('h4');
                const infoDiv = document.createElement('div');
                infoDiv.classList.add('info');

                createImg.src = cachorro.link;
                li.appendChild(createImg);
                
                         
                nameEl.textContent = cachorro.nome;
                infoDiv.appendChild(nameEl);
                               
                racaEl.textContent = cachorro.raca;
                infoDiv.appendChild(racaEl);
                               
                generoEl.textContent = cachorro.genero;
                infoDiv.appendChild(generoEl);
                
                idadeEl.textContent = cachorro.idade;
                infoDiv.appendChild(idadeEl);
                
                localizacaoEl.classList.add('location');
                localizacaoEl.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
</svg> ${cachorro.localizacao}`;
                infoDiv.appendChild(localizacaoEl);
                
                li.appendChild(infoDiv);
                cachorroList.appendChild(li);
            });
        })
        .catch(error => console.error('Erro:', error));
}

cachorroForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const link = document.getElementById('link').value;
    const nome = document.getElementById('nome').value;
    const raca = document.getElementById('raca').value;
    const genero = document.getElementById('genero').value;
    const idade = document.getElementById('idade').value;
    const localizacao = document.getElementById('localizacao').value;

    fetch('http://localhost:3000/cachorro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ link, nome, raca, genero, idade, localizacao }),
    })
    .then(response => response.json())
    .then(() => {
        listCachorros();
        cachorroForm.reset();
    })
    .catch(error => console.error('Erro:', error));
});

listCachorros();
