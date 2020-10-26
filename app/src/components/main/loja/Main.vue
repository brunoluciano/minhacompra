<template>
  <div>
    <div
      class="row q-col-gutter-lg"
      v-if="departamentos != '' && banners != ''"
    >
      <div class="col-12 col-md-3">
        <departamentos :departamentos="departamentos"></departamentos>
      </div>
      <div class="col-12 col-md-9">
        <slide-banners :banners="banners"></slide-banners>
      </div>
      <div class="col">
        <q-separator class="q-mb-lg" />
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div v-for="painel in paineis" :key="painel">
          <painel-produtos
            :painel="painel"
            :produtos="produtos"
          ></painel-produtos>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SlideBanners from "./SlideBanners.vue";
import Departamentos from "./Departamentos.vue";
import PainelProdutos from "./PainelProdutos.vue";

export default {
  components: {
    SlideBanners,
    Departamentos,
    PainelProdutos,
  },

  data() {
    return {
      id: "",
      departamentos: [],
      banners: [],
      produtos: [],

      paineis: [
        {
          titulo: "Super Ofertas",
          tituloCor: "orange-5",
          painelCor: "#fffaef",
        },
      ],
    };
  },

  created() {
    this.id = this.$route.params.id;
    this.$http
      .get(`empresa/${this.id}/images/banner`)
      .then((res) => res.json())
      .then(
        (banners) => {
          this.banners = banners;
          this.banners.forEach((banner) => {
            banner.imgUrl = `${this.$http.options.root}/empresa/${this.id}/images/banner/${banner.id}/img`;
          });
        },
        (err) => console.log(err)
      );

    this.$http
      .get(`empresa/${this.id}/departamento`)
      .then((res) => res.json())
      .then(
        (departamentos) => {
          this.departamentos = departamentos;
        },
        (err) => console.log(err)
      );

    this.$http
      .get(`empresa/${this.id}/produto`)
      .then((res) => res.json())
      .then(
        (produtos) => {
          this.produtos = produtos;
        },
        (err) => console.log(err)
      );
  },
};
</script>

<style scoped>
</style>