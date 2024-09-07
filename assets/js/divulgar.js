const inputFile = document.querySelector('#arquivo_principal');
const pictureImage = document.querySelector('.picture_image');
const pictureImageTxt = "Seu pet";

// Inicialmente mostra o texto padrão
pictureImage.innerHTML = pictureImageTxt;

// Verifica o tipo de arquivo e exibe a imagem
inputFile.addEventListener('change', function(e) {
    const file = e.target.files[0];

    if (file) {
        // Verifica o tipo de arquivo
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (validTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.addEventListener('load', function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('picture_img');
                pictureImage.innerHTML = ''; // Limpa o conteúdo existente
                pictureImage.appendChild(img);
            });

            reader.readAsDataURL(file);
        } else {
            alert('Por favor, envie apenas arquivos de imagem (JPG, PNG).');
            inputFile.value = ''; // Limpa o campo de entrada
            pictureImage.innerHTML = pictureImageTxt; // Restaura o texto padrão
        }
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
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