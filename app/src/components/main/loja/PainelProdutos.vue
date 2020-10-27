<template>
  <div>
    <div class="row q-ma-none">
      <q-btn
        unelevated
        padding="xs xl"
        :label="painel.titulo"
        :color="painel.tituloCor"
        class="btn-titulo-painel text-weight-bold"
      />
    </div>
    <div class="row">
      <div
        class="col painel shadow-2"
        :style="{ background: painel.painelCor }"
      >
        <div class="row q-col-gutter-x-lg q-col-gutter-y-xl q-pa-md">
          <div
            class="col-12 col-sm-6 col-md-3"
            v-for="produto in produtos"
            :key="produto.id"
          >
            <card-produto :produto="produto"></card-produto>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CardProduto from "./CardProduto.vue";

export default {
  components: {
    CardProduto,
  },

  props: ["painel", "produtos"],
};
</script>

<style scoped>
.btn-titulo-painel {
  border-radius: 20px 20px 0px 0px;
}

.painel {
  border-radius: 0px 10px 10px 10px;
}
</style>
