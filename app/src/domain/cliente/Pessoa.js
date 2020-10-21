export default class Pessoa {
    constructor(id='', nome='', cpf='', sexo='', nascimento='', telefone='', endereco='', numero='', complemento='', cidade='', estado_id='', bairro='', cep='') {
        this.id = id;
        this.nome = nome;
        this.cpf = cpf;
        this.sexo = sexo;
        this.nascimento = nascimento;
        this.telefone = telefone;
        this.endereco = endereco;
        this.numero = numero;
        this.complemento = complemento;
        this.cidade = cidade;
        this.estado_id = estado_id;
        this.bairro = bairro;
        this.cep = cep;
    }
}