<template>
  <div>
    <div v-if="loadedComponent">
      <div class="row q-col-gutter-lg">
        <div class="col-12 col-md-3" v-if="departamentos != ''">
          <menu-departamentos
            :departamentos="departamentos"
          ></menu-departamentos>
        </div>
        <div class="col-12 col-md-9" v-if="banners != ''">
          <slide-banners :banners="banners"></slide-banners>
        </div>
      </div>
      <div class="row q-my-lg">
        <div class="col">
          <q-separator />
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div v-for="painel in paineis" :key="painel">
            <painel-produtos
              :painel="painel"
              :produtos="painel.produtos"
              class="q-mb-xl"
            ></painel-produtos>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="box row justify-center items-center">
        <q-spinner-tail color="blue-grey-5" size="8rem" :thickness="5" />
      </div>
    </div>
  </div>
</template>

<script>
import SlideBanners from "./SlideBanners.vue";
import MenuDepartamentos from "./MenuDepartamentos.vue";
import PainelProdutos from "./PainelProdutos.vue";

export default {
  components: {
    SlideBanners,
    MenuDepartamentos,
    PainelProdutos,
  },

  data() {
    return {
      loadedComponent: false,

      id: "",
      departamentos: [],
      banners: [],

      paineis: [
        {
          titulo: "Super Ofertas",
          tituloCor: "orange-5",
          painelCor: "#fffaef",
          produtos: [],
        },

        {
          titulo: "Para Você",
          tituloCor: "red-5",
          painelCor: "#fffaef",
          produtos: [],
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
      .get(`empresa/${this.id}/produtos/comPromocao`)
      .then((res) => res.json())
      .then(
        (produtos) => {
          this.paineis[0].produtos = produtos;
        },
        (err) => console.log(err)
      );

    this.$http
      .get(`empresa/${this.id}/produtos/semPromocao`)
      .then((res) => res.json())
      .then(
        (produtos) => {
          this.paineis[1].produtos = produtos;
          this.loadedComponent = true;
        },
        (err) => console.log(err)
      );
  },
};
</script>

<style scoped>
.box {
  min-height: 70vh;
}
</style>
