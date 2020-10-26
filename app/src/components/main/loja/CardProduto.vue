<template>
  <div>
    <q-card class="card-produto text-grey-8">
      <q-card-section>
        <q-img
          :src="imgUrl"
          spinner-color="primary"
          spinner-size="82px"
          class="img-produto"
          :ratio="1"
        />
        <q-separator class="q-my-sm" />
        <div class="text-h6 text-center">{{ produto.descricao }}</div>
      </q-card-section>
      <q-card-section>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit
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
  transition: ease 0.3s;
}
.card-produto:hover .img-produto {
  transition: ease 0.5s;
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
  overflow: hidden;
}
</style>