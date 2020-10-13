<template>
  <div>
    <q-dialog v-model="mostraModal">
      <q-card class="card q-pa-lg">
        <q-card-section class="row q-pa-none">
          <q-btn
            class="absolute-top-right"
            icon="close"
            flat
            round
            dense
            v-close-popup
          />
          <div class="text-h4 text-grey-8">
            Minhas Lojas Favoritas <q-icon name="mdi-store" />
          </div>
        </q-card-section>

        <q-separator color="grey-5 q-my-md" />

        <q-card-section class="row q-pa-none q-mb-lg">
          <q-input
            dense
            color="teal"
            v-model="text"
            label="Pesquisar por loja favorita"
            class="col-12"
          >
            <template v-slot:prepend>
              <q-icon name="search" color="teal" />
            </template>
          </q-input>
        </q-card-section>

        <q-card-section
          class="row q-pa-none q-col-gutter-x-xl q-col-gutter-y-lg"
        >
          <div class="col-12 col-md-4" v-for="n in 9" :key="n">
            <div class="row">
              <q-rating
                v-model="favorito"
                size="3em"
                max="1"
                icon="star"
                color="teal-4"
                class="col-2 q-pa-none"
              />
              <q-card
                class="shadow-3 lista-card-loja q-pa-xs bg-teal-6 col"
                bordered
              >
                <q-item class="text-white">
                  <q-item-section avatar>
                    <q-avatar class="shadow-3" size="50px">
                      <img
                        src="https://static-images.ifood.com.br/image/upload//logosgde/2959111d-2628-46c6-9fb5-a42a710ad29a/201912201539_o5xi_i.png"
                      />
                    </q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label class="ellipsis">
                      <span class="text-h5 text-weight-bold"
                        >Supermercado Supermercado

                        <q-tooltip anchor="top middle" self="center middle">
                          Supermercado Supermercado
                        </q-tooltip>
                      </span>
                    </q-item-label>
                    <q-item-label caption class="text-white"
                      >Av. Brasil, 123 - Bairro <br />
                      São Paulo - SP</q-item-label
                    >
                  </q-item-section>
                </q-item>
              </q-card>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
export default {
  props: ["mostraModal"],

  data() {
    return {
      n: 0,
      favorito: 1,
    };
  },

  watch: {
    mostraModal: function () {
      if (!this.mostraModal) {
        this.$emit("fecharModal", this.mostraModal);
      }
    },
  },
};
</script>

<style scoped>
.card {
  width: 80vw;
  max-width: 100vw;
  border-radius: 20px;
}

.lista-card-loja {
  border: 3px solid transparent;
  transition: ease 0.3s;
  border-radius: 50px;
  cursor: pointer;
}

.lista-card-loja:hover {
  transition: ease 0.3s;
  background-color: #ececec;
  border: 3px solid #004d45;
  -moz-transform: scale(1.08);
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
  overflow: hidden;
}
</style>