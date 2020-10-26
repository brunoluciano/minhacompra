<template>
<div>
    <q-card class="card-produto text-grey-8 q-pa-none">
        <q-card-section>
            <q-img :src="imgUrl" spinner-color="teal" spinner-size="82px" transition="jump-up" class="img-produto" :ratio="1" />
        </q-card-section>
        <q-separator />
        <q-card-section class="q-ma-none">
            <div class="text-h5 text-center">{{ produto.descricao }}</div>
        </q-card-section>
        <q-card-section v-if="produto.promocao_ativa" class="q-ma-none">
            <q-badge color="orange" text-color="black" label="test" />
        </q-card-section>
    </q-card>
</div>
</template>

<script>
export default {
    props: ["produto"],
    data() {
        return {
            imgUrl: "",
        };
    },

    created() {
        this.imgUrl = `${this.$http.options.root}/empresa/${this.produto.empresa.id}/images/produto/${this.produto.id}`;
    },
};
</script>

<style scoped>
.card-produto {
    transition: ease-out 0.2s;
    border: 1px solid #3cad9300;
}

.card-produto:hover {
    border: 1px solid #3cad92;
    cursor: pointer;
    transition: ease 0.3s;
    -moz-transform: scale(1.04);
    -webkit-transform: scale(1.04);
    transform: scale(1.04);
    overflow: hidden;
}

.img-produto {
    display: block;
    transition: ease 0.5s;
}

.card-produto:hover .img-produto {
    transition: ease 1s;
    -moz-transform: scale(1.06);
    -webkit-transform: scale(1.06);
    transform: scale(1.06);
    overflow: hidden;
}
</style>
