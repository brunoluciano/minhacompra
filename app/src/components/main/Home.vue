<template>
  <div>
    <main-menu>
      <div class="bg-black">
        <div
          class="row background-main-img items-center justify-center"
          v-bind:style="{
            backgroundImage:
              'linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url(' +
              image +
              ')',
          }"
        >
          <div class="col-12 col-md-8 text-center text-white q-pa-md">
            <h2 class="q-my-none">Informe o seu CEP</h2>
            <p class="text-italic">
              E encontre o supermercado mais próximo de você!
            </p>
            <q-form ref="formBuscarLojas" class="q-gutter-md">
              <q-input
                rounded
                outlined
                dark
                v-model="buscaCep.cep"
                mask="#####-###"
                unmasked-value
                color="orange"
                bg-color="dark"
                style="opacity: 0.9"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val.length == 8) ||
                    'Informe um CEP válido!',
                ]"
                v-on:keydown.enter.prevent="buscarLojas"
              >
                <template v-slot:append>
                  <q-btn
                    push
                    outline
                    flat
                    rounded
                    icon="search"
                    label="Buscar"
                    @click="buscarLojas"
                  />
                </template>
              </q-input>
            </q-form>
          </div>
        </div>
      </div>

      <div class="row q-pa-md q-col-gutter-md q-my-lg">
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-5">
            <div class="zoom-effect-container">
              <q-img
                class="image-card"
                :src="card1"
                transition="jump-up"
                spinner-color="orange"
              >
                <div class="absolute-bottom text-center bg-card-title">
                  <span class="text-h5 q-py-none text-card"
                    >Veja qual supermercado está mais próximo de você!</span
                  >
                </div>
              </q-img>
            </div>
          </q-card>
        </div>
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-5">
            <div class="zoom-effect-container">
              <q-img
                class="image-card"
                :src="card2"
                transition="jump-up"
                spinner-color="orange"
              >
                <div class="absolute-bottom text-center bg-card-title">
                  <span class="text-h5 q-py-none text-card"
                    >Faça sua compra em apenas alguns cliques!</span
                  >
                </div>
              </q-img>
            </div>
          </q-card>
        </div>
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-5">
            <div class="zoom-effect-container">
              <q-img
                class="image-card"
                :src="card3"
                transition="jump-up"
                spinner-color="orange"
              >
                <div class="absolute-bottom text-center bg-card-title">
                  <span class="text-h5 q-py-none text-card"
                    >Veja qual supermercado está mais próximo de você!</span
                  >
                </div>
              </q-img>
            </div>
          </q-card>
        </div>
      </div>

      <div class="row bg-login-empresa q-py-xl q-mb-none justify-center">
        <div class="col-12 text-white text-center">
          <h3 class="q-my-none">É uma empresa?</h3>
          <p>Cadastre sua loja agora mesmo!</p>
          <q-btn
            push
            rounded
            class="bg-btn-empresa"
            icon="fas fa-briefcase"
            label="Entrar ou Cadastrar"
            @click="abrirModalLoginEmpresa"
          />
        </div>
      </div>
      <br /><br />

      <modal-login-empresa
        :mostraModal="modal.login"
        @fecharModal="fecharModalLoginEmpresa"
      ></modal-login-empresa>
    </main-menu>
  </div>
</template>

<script>
import MainMenu from "../layout/MainMenu.vue";
import Image from "../../assets/bg_main.jpg";
import Card1 from "../../assets/card1_main.jpg";
import Card2 from "../../assets/card2_main.jpg";
import Card3 from "../../assets/card1_main.jpg";
import ModalLoginEmpresa from "./ModalLoginEmpresa.vue";

export default {
  name: "LayoutDefault",

  data() {
    return {
      buscaCep: {
        cep: "",
      },

      image: Image,
      card1: Card1,
      card2: Card2,
      card3: Card3,
      modal: {
        login: false,
      },
    };
  },

  components: {
    MainMenu,
    ModalLoginEmpresa,
  },

  methods: {
    buscarLojas() {
      this.$refs.formBuscarLojas.validate().then(() => {
        this.$router.push({
          name: "buscarlojasbycep",
          params: {
            cep: this.buscaCep.cep,
          },
        });
      });
    },
    abrirModalLoginEmpresa() {
      this.modal.login = true;
    },
    fecharModalLoginEmpresa(val) {
      this.modal.login = val.target;
    },
  },
};
</script>

<style scoped>
.background-main-img {
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center top;
  height: 45vh;
}

.filter-image {
  background-color: black;
}

.zoom-effect-container {
  overflow: hidden;
}

.image-card {
  display: block;
  -moz-transition: all 0.8s;
  -webkit-transition: all 0.8s;
  transition: all 0.8s;
}

.zoom-effect-container:hover .image-card {
  cursor: pointer;
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.bg-card-title {
  background: rgba(247, 172, 67, 0.75);
}

.bg-login-empresa {
  background-color: #86afb8;
}

.bg-btn-empresa {
  background-color: #36c1a3;
}

.text-card {
  text-shadow: 1px 1px 3px #808080;
}
</style>
