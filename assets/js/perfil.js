document.getElementById('showForm').addEventListener('click', function() {
    document.getElementById('userContainer').classList.add('hidden');
    document.getElementById('updateContainer').classList.remove('hidden');
});

document.getElementById('showUser').addEventListener('click', function() {
    document.getElementById('updateContainer').classList.add('hidden');
    document.getElementById('userContainer').classList.remove('hidden');
});

    // Preenche os campos do formulário com os dados do usuário armazenados na sessão
    document.addEventListener('DOMContentLoaded', function() {
        const username = sessionStorage.getItem('username');
        const email = sessionStorage.getItem('email');

        document.getElementById('updateUsername').value = username;
        document.getElementById('updateEmail').value = email;

        document.getElementById('userInfoUsername').innerText = username;
        document.getElementById('userInfoEmail').innerText = email;
    });

    // Submissão do formulário de atualização
    document.getElementById('updateForm').addEventListener('submit', async function(event) {
        event.preventDefault(); // Previne o comportamento padrão do formulário
        const username = document.getElementById('updateUsername').value;
        const password = document.getElementById('updatePassword').value;
        const email = document.getElementById('updateEmail').value;

        // Envia os dados de atualização para o servidor
        const response = await fetch('server.php?action=update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password, email })
        });

        const result = await response.json(); // Converte a resposta em JSON
        document.getElementById('updateResponse').innerText = result.message; // Exibe a mensagem de resposta
        if (result.success) {
            sessionStorage.setItem('email', email); // Atualiza o email armazenado na sessão
            document.getElementById('userInfoEmail').innerText = email; // Atualiza o email exibido
        }
    });

    // Deletar a conta do usuário
    document.getElementById('deleteUsuario').addEventListener('click', async function() {
        const nome_usuario = sessionStorage.getItem('nome_usuario');

        // Envia a solicitação de deleção para o servidor
        const response = await fetch('server.php?action=delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nome_usuario })
        });

        const result = await response.json(); 
        alert(result.message); 
        if (result.success) {
            sessionStorage.clear();
            window.location.href = 'index.html'; 
        }
    });