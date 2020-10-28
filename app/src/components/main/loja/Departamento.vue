<template>
<div>
    <div class="row">
        <div class="col-12 col-md-3">
        </div>
        <div class="col-12 col-md-9">
            <painel-produtos :painel="painel" :produtos="painel.produtos"></painel-produtos>
        </div>
    </div>
</div>
</template>

<script>
import PainelProdutos from "./PainelProdutos.vue";

export default {
    components: {
        PainelProdutos
    },

    data() {
        return {
            painel: {
                titulo: "",
                tituloCor: "orange-5",
                painelCor: "#fffaef",
                col_size: 'col-md-4',
                produtos: [],
            },
        }
    },

    created() {
        const lojaId = this.$route.params.loja;
        const departamentoId = this.$route.params.departamento;
        this.$http
            .get(`empresa/${lojaId}/produtos/departamento/${departamentoId}`)
            .then((res) => res.json())
            .then(
                (produtos) => {
                    this.painel.produtos = produtos;
                    this.painel.titulo = produtos[0].departamento.descricao;
                    console.log(produtos)
                },
                (err) => console.log(err)
            );
    },
};
</script>

<style scoped>
</style>
