import { Usuario } from "../../../model/Usuario";
import { UsuarioRepositorio } from "../../../model/repository/UsuarioRepositorio";


export class UsuarioRepositorioEmMemoria implements UsuarioRepositorio {

    private UsuarioColetor: Array<Usuario> = []

    async save(usuario: Usuario): Promise<void> {
         this.UsuarioColetor.push(usuario)
    }

}