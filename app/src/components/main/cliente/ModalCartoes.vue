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
            Meus Cartões <q-icon name="credit_card" />
          </div>
        </q-card-section>

        <q-separator color="grey-5 q-my-md" />

        <q-card-section class="row q-pa-none q-mb-md">
          <q-input
            dense
            color="teal"
            v-model="text"
            label="Pesquisar por cartão"
            class="col-12 col-md-4"
          >
            <template v-slot:prepend>
              <q-icon name="search" color="teal" />
            </template>
          </q-input>
          <q-btn
            dense
            outline
            rounded
            color="teal"
            icon="add"
            label="Novo Cartão"
            class="col-12 col-md-2"
          />
        </q-card-section>

        <q-card-section
          class="row q-pa-none q-col-gutter-x-lg q-col-gutter-y-lg"
        >
          <div class="col-12 col-sm-6 col-md-4" v-for="n in 3" :key="n">
            <q-card
              class="shadow-3 q-pa-sm q-py-lg bg-gradient-cartao text-white"
              bordered
            >
              <div class="row text-center items-center q-pa-none">
                <div class="col-2">
                  <q-icon name="mdi-card-bulleted-outline" size="3rem" />
                </div>
                <div class="col-10">
                  <div class="text-h5 text-cartao text-weight-light">
                    {{ cartao.numero }}
                  </div>
                </div>
              </div>
              <q-separator spaced color="grey-4" />
              <div class="row items-center q-pa-none">
                <div class="col-2 offset-2">
                  <div class="text-p text-weight-light">
                    Val.
                    <div class="text-cartao">{{ cartao.validade }}</div>
                  </div>
                </div>
                <div class="col-8">
                  <div class="text-p text-weight-light">
                    Titular
                    <div class="text-cartao text-uppercase">
                      {{ cartao.titular }}
                    </div>
                  </div>
                </div>
              </div>
            </q-card>
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
      cartao: {
        numero: "1234 5678 9102 3456",
        fabricado: "07/19",
        validade: "07/25",
        titular: "Cliente S Fulano",
      },
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
@import url("https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap");

.card {
  width: 80vw;
  max-width: 100vw;
  border-radius: 20px;
}

.bg-gradient-cartao {
  background: rgb(138, 164, 177);
  background: -moz-radial-gradient(
    circle,
    rgba(138, 164, 177, 1) 0%,
    rgba(89, 111, 121, 1) 100%
  );
  background: -webkit-radial-gradient(
    circle,
    rgba(138, 164, 177, 1) 0%,
    rgba(89, 111, 121, 1) 100%
  );
  background: radial-gradient(
    circle,
    rgba(138, 164, 177, 1) 0%,
    rgba(89, 111, 121, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#8aa4b1",endColorstr="#596f79",GradientType=1);

  border: 3px solid transparent;
  transition: ease 0.3s;
  border-radius: 20px;
  cursor: pointer;
}

.bg-gradient-cartao:hover {
  transition: ease 0.3s;
  border: 3px solid #42555e;
  -moz-transform: scale(1.08);
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
  overflow: hidden;
}

.text-cartao {
  font-family: "Bree Serif", serif;
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
}
</style>