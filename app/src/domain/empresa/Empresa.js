export default class Empresa {
    constructor(id = '', nome = '', cnpj = '', imgLogo = '', telefone = '', endereco = '', numero = '', complemento = '', cidade = '', estado_id = '', bairro = '', cep = '') {
        this.id = id;
        this.nome = nome;
        this.cnpj = cnpj;
        this.imgLogo = imgLogo;
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