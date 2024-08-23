// Alterna entre os formulários de login e registro
document.getElementById('showRegister').addEventListener('click', function() {
    document.getElementById('loginContainer').classList.add('hidden');
    document.getElementById('registerContainer').classList.remove('hidden');
});

document.getElementById('showLogin').addEventListener('click', function() {
    document.getElementById('registerContainer').classList.add('hidden');
    document.getElementById('loginContainer').classList.remove('hidden');
});

const registerEmail = document.querySelector("#registerEmail");
const registerContainer = document.querySelector("#registerContainer");

registerContainer.addEventListener("submit", function (event) {
    const email = registerEmail.value;
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
