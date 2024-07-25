import { Request, Response } from "express"
import { UsuarioRepositorio } from "../model/repository/UsuarioRepositorio";

export class UsuarioCreate {

    constructor(readonly repository: UsuarioRepositorio) {

    }
    execute(request: Request, responde: Response) {
        const {usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_cidade } = request.body
    }
}