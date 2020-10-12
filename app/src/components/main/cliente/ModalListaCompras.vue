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
            Minhas Listas de Compras <q-icon name="assignment" />
          </div>
        </q-card-section>

        <q-separator color="grey-5 q-my-md" />

        <q-card-section class="row q-pa-none q-mb-md">
          <q-input
            dense
            color="teal"
            v-model="text"
            label="Pesquisar por lista"
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
            label="Nova Lista"
            class="col-12 col-md-2"
          />
        </q-card-section>

        <q-card-section class="row q-pa-none">
          <q-list bordered class="col-12 rounded-borders shadow-2">
            <q-expansion-item
              group="listacompras"
              v-for="item in listacompras"
              :key="item"
              :class="item.bg"
            >
              <template v-slot:header>
                <q-item-section avatar>
                  <q-icon name="shopping_cart" :color="item.cor" size="2rem" />
                </q-item-section>

                <q-item-section>
                  <div class="text-uppercase text-weight-bold text-grey-9">
                    {{ item.descricao }}
                  </div>
                </q-item-section>
              </template>
              <q-card>
                <q-card-section>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Quidem, eius reprehenderit eos corrupti commodi magni quaerat
                  ex numquam, dolorum officiis modi facere maiores architecto
                  suscipit iste eveniet doloribus ullam aliquid.
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-list>
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
      listacompras: [
        {
          descricao: "Compra do mês",
          cor: "green",
        },
        {
          descricao: "Churrasco",
          cor: "orange",
        },
        {
          descricao: "Aniversário",
          cor: "blue",
        },
      ],
    };
  },

  created: function () {
    this.listacompras.forEach((item) => {
      let cor = item.cor;
      item.cor = `${cor}-6`;
      item.bg = `bg-${cor}-2`;
    });
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
</style>