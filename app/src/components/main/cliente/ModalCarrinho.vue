<template>
  <div>
    <q-dialog v-model="mostraModal">
      <q-card class="card q-pa-lg">
        <q-card-section class="row q-pa-none q-mb-md">
          <q-btn
            class="absolute-top-right"
            icon="close"
            flat
            round
            dense
            v-close-popup
          />
          <div class="text-h4 text-grey-8">
            Meu Carrinho de Compra
            <q-icon name="shopping_cart" />
          </div>
        </q-card-section>

        <q-card-section class="row q-pa-md bg-blue-grey-4">
          <div class="text-h5 text-white text-weight-bold text-uppercase">
            Produtos
          </div>
          <q-separator color="white" class="q-mb-md" />
          <div class="col-12">
            <q-markup-table dense separator="cell" class="table-carrinho">
              <thead class="text-center sticky-head">
                <tr class="text-white bg-teal text-uppercase">
                  <th class="bold custom-font">Produto</th>
                  <th class="bold custom-font">Preço</th>
                  <th class="bold custom-font">Quantidade</th>
                  <th class="bold custom-font">Sub-total</th>
                </tr>
              </thead>
              <tbody class="text-center text-grey-8">
                <tr v-for="n in 10" :key="n">
                  <td class="text-center">
                    <q-list>
                      <q-item>
                        <q-item-section>
                          <q-item-label>
                            <q-btn dense round color="red-5" padding="xs">
                              <q-icon name="close" size="1em" />
                            </q-btn>
                            <q-avatar class="shadow-4 q-mx-md">
                              <q-img
                                src="https://www.kindpng.com/picc/m/411-4119926_cardboard-box-png-clip-art-image-transparent-png.png"
                                spinner-color="teal"
                                spinner-size="50px"
                                :thickness="5"
                                transition="jump-up"
                                :ratio="1"
                              />
                            </q-avatar>
                            <span class="text-subtitle2 ellipsis">
                              Produto Produto Produto Produto
                            </span>
                          </q-item-label>
                        </q-item-section>
                      </q-item>
                    </q-list>
                  </td>
                  <td class="custom-font">R$ 123,00</td>
                  <td>
                    <q-input
                      ref="inputQtd"
                      rounded
                      outlined
                      dense
                      v-model.number="quantidade"
                      color="blue-grey-4"
                      type="number"
                      input-class="text-subtitle1 text-grey-8 text-center"
                      :rules="[
                        (val) =>
                          (val >= 1 && val <= produto.estoque_atual) ||
                          `Valor inválido!`,
                      ]"
                      class="q-pb-none"
                    >
                      <template v-slot:before>
                        <q-btn
                          round
                          dense
                          color="btn-quantidade"
                          icon="remove"
                          @click="menosQtdProduto"
                        />
                      </template>
                      <template v-slot:after>
                        <q-btn
                          round
                          dense
                          color="btn-quantidade"
                          icon="add"
                          @click="maisQtdProduto"
                        />
                      </template>
                    </q-input>
                  </td>
                  <td class="custom-font">R$ 123,00</td>
                </tr>
              </tbody>
            </q-markup-table>
          </div>
          <div class="col-12">
            <q-btn-group spread class="rounded-buttons">
              <q-btn
                color="blue-grey-3"
                icon="mdi-broom"
                label="Limpar Carrinho"
              />
              <q-btn color="orange-4" icon="mdi-currency-usd">
                <div class="custom-font">123,00</div>
              </q-btn>
              <q-btn
                color="green-5"
                icon="mdi-cart-check"
                label="Finalizar Compra"
              />
            </q-btn-group>
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
      quantidade: 0,
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
@import url("https://fonts.googleapis.com/css2?family=Oswald&display=swap");

.card {
  width: 80vw;
  max-width: 100vw;
  border-radius: 20px;
}

.bold {
  font-weight: bold !important;
  font-size: 1em;
}

.bg-btn-quantidade {
  background: #8abbbf;
}

.custom-font {
  font-family: "Oswald", sans-serif;
}

.table-carrinho {
  border-radius: 20px 20px 0px 0px;
  max-height: 45vh !important;
  overflow-y: scroll;
  overflow-x: auto;
}

.rounded-buttons {
  border-radius: 0px 0px 20px 20px;
}
</style>
