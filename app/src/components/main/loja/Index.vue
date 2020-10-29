<template>
  <div class="bg-custom q-py-md">
    <main-menu>
      <div class="row q-mx-lg q-mb-none text-white items-end justify-between">
        <div class="col-12 col-md-6" @click="goToLojaHome()">
          <q-item class="info-loja">
            <q-item-section avatar>
              <q-avatar size="70px" class="shadow-4 bg-white">
                <q-img
                  :src="loja.imgUrl"
                  transition="fade"
                  spinner-color="grey"
                  class="image-card"
                />
              </q-avatar>
            </q-item-section>

            <q-item-section class="text-shadow">
              <q-item-label class="q-ma-none">
                <div class="text-h4 text-weight-bold text-uppercase">
                  {{ loja.nome }}
                </div>
              </q-item-label>
              <q-item-label caption class="q-ma-none q-pa-none">
                <div class="text-p text-white">
                  {{ loja.endereco }}, {{ loja.numero }} - {{ loja.bairro }},
                  {{ loja.cidade }} - {{ loja.estado.sigla }}
                </div>
              </q-item-label>
            </q-item-section>
          </q-item>
        </div>
        <!-- <div class="col-12 col-md-3"> -->
        <q-item>
          <q-item-section>
            <q-btn
              outline
              rounded
              color="white"
              icon="logout"
              label="Voltar para Supermercados"
              no-caps
              @click="voltarSupermercados"
            />
          </q-item-section>
        </q-item>
        <!-- </div> -->
      </div>
      <div class="q-mx-md q-pa-lg bg-white shadow-4 row-loja-content">
        <router-view> </router-view>
      </div>
    </main-menu>
  </div>
</template>

<script>
import MainMenu from "../../layout/MainMenu.vue";

export default {
  data() {
    return {
      loja: [],
    };
  },

  components: {
    MainMenu,
  },

  created() {
    let id = this.$route.params.id;
    this.$http
      .get(`empresa/${id}`)
      .then((res) => res.json())
      .then(
        (loja) => {
          this.loja = loja;
          this.loja.imgUrl = `${this.$http.options.root}/empresa/${loja.id}/images/logo`;
        },
        (err) => console.log(err)
      );
  },

  methods: {
    voltarSupermercados() {
      this.$router.push({
        name: "buscarlojasbycep",
        params: {
          cep: this.loja.cep,
        },
      });
    },

    goToLojaHome() {
      this.$router.push({
        name: "lojaMain",
        params: {
          id: this.loja.id,
        },
      });
    },
  },
};
</script>

<style scoped>
.bg-custom {
  background: #87a8af;
}

.text-shadow {
  text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.row-loja-content {
  border-radius: 20px;
  min-height: 70vh;
}

.info-loja {
  cursor: pointer;
}

.image-card {
  display: block;
  -moz-transition: all 0.5s;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}

.info-loja:hover .image-card {
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
