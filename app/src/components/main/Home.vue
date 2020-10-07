<template v-slot:placeholder>
  <div>
    <main-menu>
      <q-img
        class="filter-image"
        :src="image"
        style="max-height: 50vh"
        transition="fade"
      />

      <div class="row q-pa-md q-pb-none">
        <div class="col-12">
          <router-link :to="{ name: 'buscarlojas' }">
            <q-btn
              class="q-mb-sm"
              color="primary"
              icon="location_on"
              label="Encontrar lojas próximas"
              @click="onClick"
            />
          </router-link>
        </div>
      </div>

      <div class="row q-pa-md justify-center q-col-gutter-x-md q-mb-lg">
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-lg">
            <q-img :src="card1" basic transition="fade">
              <div class="absolute-bottom text-center bg-card-title">
                <span class="text-h5 q-py-none"
                  >Veja qual supermercado está mais próximo de você!</span
                >
              </div>
            </q-img>
          </q-card>
        </div>
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-lg">
            <q-img :src="card1" basic transition="fade">
              <div class="absolute-bottom text-center bg-card-title">
                <span class="text-h5 q-py-none"
                  >Veja qual supermercado está mais próximo de você!</span
                >
              </div>
            </q-img>
          </q-card>
        </div>
        <div class="col-12 col-md-4">
          <q-card class="my-card shadow-lg">
            <q-img :src="card1" basic transition="fade">
              <div class="absolute-bottom text-center bg-card-title">
                <span class="text-h5 q-py-none"
                  >Veja qual supermercado está mais próximo de você!</span
                >
              </div>
            </q-img>
          </q-card>
        </div>
      </div>

      <div
        class="row bg-login-empresa q-py-lg q-mb-none justify-center"
        style="min-height: 30vh"
      >
        <div class="col-4 text-white">
          <h3>É uma empresa?</h3>
        </div>
      </div>
      <br /><br />
    </main-menu>
  </div>
</template>

<script>
import MainMenu from "../layout/MainMenu.vue";
import Image from "../../assets/bg_main.jpg";
import Card1 from "../../assets/card1_main.jpg";
import Card2 from "../../assets/card1_main.jpg";
import Card3 from "../../assets/card1_main.jpg";

export default {
  name: "LayoutDefault",

  components: {
    // LayoutComponent,
    MainMenu,
  },

  data() {
    return {
      image: Image,
      card1: Card1,
      card2: Card2,
      card3: Card3,
    };
  },
};
</script>

<style scoped>
.filter-image {
  background-color: black;
}

.bg-card-title {
  background-color: rgba(247, 172, 67, 0.75);
}

.bg-login-empresa {
  background-color: #86afb8;
}
</style>