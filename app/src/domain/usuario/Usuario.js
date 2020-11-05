export default class Usuario {
    constructor(nome='', email='', password='', tipo_usuario_id='') {
        this.nome = nome;
        this.email = email;
        this.password = password;
        this.tipo_usuario_id = tipo_usuario_id;
    }
}