document.getElementById('arquivo_principal').addEventListener('change', function(event) {
    const galeria = document.getElementById('galeria1');
    galeria.innerHTML = ''; 
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        galeria.appendChild(img);
    }

    reader.readAsDataURL(file);
});

const registerContainer = document.querySelector("#registerContainer");
const emailInput = document.querySelector("#registerGmail");

registerContainer.addEventListener("submit", function (event) {
    const email = emailInput.value;
    const isValid = validateEmail(email);

    if (!isValid) {
        event.preventDefault(); 
        alert("Por favor, insira um endereço de email válido.");
    }
});

const validateEmail = (email) => {
    const regex = /^[^\s]+@[^\s]+\.[^\s]+$/; 
    return regex.test(email);
};