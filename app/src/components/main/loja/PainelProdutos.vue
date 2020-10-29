<template>
  <div>
    <div class="row q-ma-none">
      <q-btn
        unelevated
        padding="xs xl"
        :label="painel.titulo"
        :color="painel.tituloCor"
        class="btn-titulo-painel text-weight-bold text-white"
        :style="{ background: painel.tituloCor2 }"
      />
    </div>
    <div class="row">
      <div
        class="col painel shadow-2"
        :style="{
          background: painel.painelCor,
          borderTop: `2px solid ${painel.tituloCor2}`,
        }"
      >
        <div v-if="produtos != ''">
          <div class="row q-col-gutter-x-lg q-col-gutter-y-xl q-pa-md">
            <div
              class="col-12 col-sm-6 col-md-3"
              v-for="produto in produtos"
              :key="produto.id"
              :class="painel.col_size"
            >
              <card-produto :produto="produto"></card-produto>
            </div>
          </div>
        </div>
        <div v-else>
          <div
            class="row justify-center items-center q-pa-lg row-nenhum-produto"
          >
            <div class="col-12 q-pa-lg text-center">
              <div class="text-h4 text-blue-grey-7 custom-font">
                <q-icon name="mdi-emoticon-sad-outline" /> Nenhum produto
                encontrado!
              </div>
            </div>
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
@import url("https://fonts.googleapis.com/css2?family=Oswald&display=swap");

.btn-titulo-painel {
  border-radius: 20px 20px 0px 0px;
}

.painel {
  border-radius: 0px 10px 10px 10px;
}

.bg-departamentos {
  background: #2970a4;
  border-top: 2px solid #2970a4;
}

.row-nenhum-produto {
  min-height: 40vh;
}

.custom-font {
  font-family: "Oswald", sans-serif;
}
</style>
