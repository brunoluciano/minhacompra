export default class Produto {
    constructor(id='', descricao='', empresa_id='', departamento_id='', categoria_id='', marca_id='', unidade_medida_id='', unidade='', cod_barras='', estoque_minimo='', estoque_atual='', estoque_maximo='', preco='', imgProduto='', promocao_ativa='') {
        this.id = id;
        this.descricao = descricao;
        this.empresa_id = empresa_id;
        this.departamento_id = departamento_id;
        this.categoria_id = categoria_id;
        this.marca_id = marca_id;
        this.unidade_medida_id = unidade_medida_id;
        this.unidade = unidade;
        this.cod_barras = cod_barras;
        this.estoque_minimo = estoque_minimo;
        this.estoque_atual = estoque_atual;
        this.estoque_maximo = estoque_maximo;
        this.preco = preco;
        this.imgProduto = imgProduto;
        this.promocao_ativa = promocao_ativa;
    }
}