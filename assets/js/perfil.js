function confirmDeletion(event) {
    if (!confirm("Tem certeza de que deseja deletar sua conta? Esta ação não pode ser desfeita.")) {
        event.preventDefault(); 
    }
}