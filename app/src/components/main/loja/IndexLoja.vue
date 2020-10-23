<template>
<div>
    <q-avatar class="shadow-3" size="60px">
        <q-img :src="loja.imgUrl" transition="fade" spinner-color="grey" />
    </q-avatar>
    <div>{{ loja.nome }}</div>

</div>
</template>

<script>
export default {
    data() {
        return {
            loja: []
        }
    },

    created() {
        let id = this.$route.params.id;
        this.$http.get(`empresa/${id}`)
            .then((res) => res.json())
            .then((loja) => {
                this.loja = loja;
                this.loja.imgUrl = `${this.$http.options.root}/empresa/${loja.id}/images/logo`;
            }, (err) => console.log(err));
    },
}
</script>

<style scoped>

</style>
