import { Usuario } from "../Usuario"

export interface UsuarioRepositorio {
    save(usuario: Usuario): Promise<void>
}