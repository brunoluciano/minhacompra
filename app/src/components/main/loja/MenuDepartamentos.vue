<template>
<div>
    <q-btn rounded color="departamentos" icon="list" label="Departamentos" class="full-width" />
    <q-list bordered separator class="shadow-2 list-departamentos rounded-bottoms text-grey-8">
        <q-item clickable v-ripple:indigo v-for="departamento in departamentos" :key="departamento.id">
            <q-item-section @click="irParaDepartamento(departamento.empresa_id, departamento.id)">{{
          departamento.descricao
        }}</q-item-section>
        </q-item>
    </q-list>
</div>
</template>

<script>
export default {
    props: ["departamentos"],

    methods: {
        irParaDepartamento(loja_id, departamento_id) {
            this.$router.push({
                name: "departamento",
                params: {
                    loja: loja_id,
                    departamento: departamento_id,
                },
            });
        },
    },
};
</script>

<style scoped>
.bg-departamentos {
    background: #2970a4;
}

.list-departamentos {
    margin: -5px 10px 0px 10px;
}

.rounded-bottoms {
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
}
</style>
