import { Uuid } from "./Uuid"

export class Usuario {
    private usuario_id: Uuid
    private usuario_nome: string
    private usuario_email: string
    private usuario_senha: string
    private usuario_telefone: string
    private usuario_cidade: string

    constructor(usuario_id: Uuid, usuario_nome: string, usuario_email: string, usuario_senha: string, usuario_telefone: string, usuario_cidade: string) {
        this.usuario_id
        this.usuario_nome
        this.usuario_email
        this.usuario_senha
        this.usuario_telefone
        this.usuario_cidade
    }

    static create(usuario_nome: string, usuario_email: string, usuario_senha: string, usuario_telefone: string, usuario_cidade: string, usuario_id?: string): Usuario {
        return new Usuario(usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_cidade, uuid)
    }
}