<template>
  <div>
    <q-card class="card-produto text-grey-8 q-pa-none">
      <q-card-section class="text-center">
        <q-img
          :src="imgUrl"
          spinner-color="teal"
          spinner-size="100px"
          :thickness="10"
          transition="jump-up"
          class="img-produto"
          :ratio="1"
        />
      </q-card-section>

      <q-separator />

      <q-card-section class="q-pb-xs">
        <div
          class="text-h5 text-center ellipsis-2-lines custom-font text-capitalize"
        >
          {{ produto.descricao }}
        </div>
      </q-card-section>

      <q-card-section class="q-pt-none text-center">
        <div v-if="produto.promocao_ativa">
          <div class="text-subtitle1 custom-font text-grey text-strike">
            de R$ {{ formatPrice(produto.preco) }}
          </div>
          <div class="text-h6 custom-font text-preco">
            por R$ {{ formatPrice(produto.promocao.novo_preco) }}
            <q-badge outline align="middle" color="badge-promocao"
              >-{{ produto.promocao.porcentagem }}%</q-badge
            >
          </div>
        </div>
        <div v-else>
          <div class="text-h6 custom-font text-preco">
            por R$ {{ formatPrice(produto.preco) }}
          </div>
        </div>
      </q-card-section>

      <q-card-section class="q-pa-none q-px-lg">
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
              (val >= 1 && val <= produto.estoque_atual) || `Valor inválido!`,
          ]"
          class="no-number-style"
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
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-btn
          push
          rounded
          color="btn-add-carrinho"
          icon="shopping_cart"
          label="Adicionar ao Carrinho"
          @click="adicionarCarrinho"
          class="full-width"
          no-caps
        />
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
      quantidade: "",
    };
  },

  created() {
    this.imgUrl = `${this.$http.options.root}/empresa/${this.produto.empresa.id}/images/produto/${this.produto.id}`;
    this.quantidade = 1;
  },

  methods: {
    maisQtdProduto() {
      let val = this.quantidade;
      if (val++ < this.produto.estoque_atual) {
        this.quantidade++;
      }
    },
    menosQtdProduto() {
      let val = this.quantidade;
      if (val-- != 1) {
        this.quantidade--;
      }
    },

    adicionarCarrinho() {
      this.$root.qtdItensCarrinho++;
    },

    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
  },

  mounted() {
    this.$refs.inputQtd.validate();
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Oswald&display=swap");

.fade-enter,
.fade-leave-active {
  opacity: 0;
}

.card-produto {
  transition: ease-out 0.2s;
  border: 2px solid #3cad9300;
  border-radius: 20px;
}

.card-produto:hover {
  border: 2px solid #3cad92;
  cursor: pointer;
  transition: ease 0.3s;
  -moz-transform: scale(1.04);
  -webkit-transform: scale(1.04);
  transform: scale(1.04);
  overflow: hidden;
}

.img-produto {
  /* display: block; */
  transition: ease 0.5s;
  max-width: 12em;
}

.card-produto:hover .img-produto {
  transition: ease 1s;
  -moz-transform: scale(1.15);
  -webkit-transform: scale(1.15);
  transform: scale(1.15);
  overflow: hidden;
}

.bg-btn-quantidade {
  background: #8abbbf;
}

.text-badge-promocao {
  color: #8abbbf;
}

.bg-btn-add-carrinho {
  background: #379c85;
}

.custom-font {
  font-family: "Oswald", sans-serif;
}

.text-preco {
  color: #379c85;
  font-weight: bold;
}
</style>
