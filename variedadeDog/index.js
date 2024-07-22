const dados = require('./js/dados.json')
const express = require('express')
const fs = require('fs')
const cors = require('cors')

const server = express()
server.use(cors())
server.use(express.json())

server.listen(3000, () => {
    console.log("Server tá funcionando");
})

server.post('/cachorro', (req, res) => {
    const novoCachorro = req.body

    if(!novoCachorro.nome || !novoCachorro.raca|| !novoCachorro.genero || !novoCachorro.idade || !novoCachorro.localizacao){
        return res.status(400).json({mensagem: "Dados incompletos, tente novamente"})
    } else {
        dados.Cachorro.push(novoCachorro)
        salvarDados(dados)

        return res.status(201).json({mensagem: "Dados completos, cadastro feito com sucesso!"})
    }
})

server.get('/cachorro', (req, res) => {
    return res.json(dados.Cachorro)
})

server.put('/cachorro/:id', (req, res) => {
    const cachorroId = parseInt(req.params.id);
    const atualizarUser = req.body;

    const indiceCachorro = dados.Cachorro.findIndex(cachorro => cachorro.id === cachorroId);

    if (indiceCachorro === -1){
        return res.status(404).json({mensagem: "Usuário não encontrado"});
    }

    dados.Cachorro[indiceCachorro].nome = atualizarUser.nome || dados.Cachorro[indiceCachorro].nome;

     dados.Cachorro[indiceCachorro].raca = atualizarUser.raca || dados.Cachorro[indiceCachorro].raca;

     dados.Cachorro[indiceCachorro].genero = atualizarUser.genero || dados.Cachorro[indiceCachorro].genero;

    dados.Cachorro[indiceCachorro].idade = atualizarUser.idade || dados.Cachorro[indiceCachorro].idade;

    dados.Cachorro[indiceCachorro].localizacao = atualizarUser.localizacao || dados.Cachorro[indiceCachorro].localizacao;

    salvarDados(dados);

    return res.json({mensagem: "Cachorro atualizado com sucesso", cachorro: dados.Cachorro[indiceCachorro]});
})

server.delete('/cachorro/:id', (req, res) => {
    const id = parseInt(req.params.id);
    dados.Cachorro = dados.Cachorro.filter(u => u.id !== id);

    salvarDados(dados);
    return res.status(200).json({ mensagem: "Cachorro excluido com sucesso."});
});


function salvarDados(){
    fs.writeFileSync(__dirname + '/js/dados.json', JSON.stringify(dados, null, 2))
}

