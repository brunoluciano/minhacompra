<template>
  <div>
    <div v-if="loadedComponent">
      <div class="row q-col-gutter-x-lg q-col-gutter-y-xl">
        <div class="col-12 col-md-3">
          <q-card class="card-cliente shadow-5">
            <q-card-section class="bg-title-card text-white q-pa-xs">
              <div class="text-h5 text-center">Filtrar Produtos</div>
            </q-card-section>
            <q-card-section class="q-pa-none data-perfil">
              <q-list bordered padding>
                <q-item-label header class="q-py-none text-weight-bold"
                  >Preço</q-item-label
                >

                <q-item class="q-pb-none">
                  <q-item-section>
                    <q-input
                      outlined
                      v-model="filtro.preco.min"
                      type="number"
                      prefix="R$"
                      label="Mín."
                      placeholder="0,00"
                      color="blue-grey-4"
                    >
                    </q-input>
                  </q-item-section>
                  <q-item-section>
                    <q-input
                      outlined
                      v-model.number="filtro.preco.max"
                      type="number"
                      prefix="R$"
                      label="Máx."
                      placeholder="0,00"
                      color="blue-grey-4"
                    >
                    </q-input>
                  </q-item-section>
                </q-item>
                <q-item class="q-py-none">
                  <q-item-section>
                    <q-range
                      v-model="filtro.preco"
                      :min="0"
                      :max="200"
                      :step="10"
                      color="filtro"
                    />
                  </q-item-section>
                </q-item>

                <q-separator spaced />

                <q-item-label header class="q-py-none text-weight-bold"
                  >Promoção</q-item-label
                >

                <q-item tag="label" v-ripple>
                  <q-item-section side top>
                    <q-checkbox
                      v-model="filtro.promocao.ativa"
                      color="blue-grey-5"
                    />
                  </q-item-section>

                  <q-item-section>
                    <q-item-label>Produtos em promoção</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced />

                <q-item class="q-py-none">
                  <q-item-section>
                    <q-btn
                      rounded
                      icon="mdi-filter-outline"
                      color="filtro"
                      label="Aplicar"
                      no-caps
                      @click="aplicarFiltro()"
                    />
                    <q-btn
                      v-show="filtro.ativo"
                      rounded
                      dense
                      outline
                      icon="close"
                      color="grey-7"
                      label="Remover todos os filtros"
                      padding="none"
                      no-caps
                      class="q-mt-sm"
                      @click="removerFiltros()"
                    />
                  </q-item-section>
                </q-item>
              </q-list>
            </q-card-section>
          </q-card>
        </div>
        <div class="col-12 col-md-9">
          <painel-produtos
            :painel="painel"
            :produtos="produtrosFiltrados"
          ></painel-produtos>
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
import PainelProdutos from "./PainelProdutos.vue";

export default {
  components: {
    PainelProdutos,
  },

  data() {
    return {
      loadedComponent: false,

      filtro: {
        ativo: false,

        preco: {
          min: 0,
          max: 200,
        },
        promocao: {
          ativa: false,
        },
      },

      painel: {
        titulo: "",
        // tituloCor: "blue-5",
        tituloCor2: "#2970a4",
        painelCor: "#fffaef",
        col_size: "col-md-4",
        produtos: [],
      },

      produtrosFiltrados: [],
    };
  },

  created() {
    const lojaId = this.$route.params.loja;
    const departamentoId = this.$route.params.departamento;
    this.$http
      .get(`empresa/${lojaId}/departamento/${departamentoId}`)
      .then((res) => res.json())
      .then(
        (departamento) => {
          this.painel.titulo = departamento.descricao;

          this.$http
            .get(`empresa/${lojaId}/produtos/departamento/${departamentoId}`)
            .then((res) => res.json())
            .then(
              (produtos) => {
                this.loadedComponent = true;
                this.painel.produtos = produtos;
                this.produtrosFiltrados = produtos;
                this.painel.titulo = produtos[0].departamento.descricao;
              },
              (err) => console.log(err)
            );
        },
        (err) => console.log(err)
      );
  },

  methods: {
    aplicarFiltro() {
      this.filtro.ativo = true;

      if (this.filtro.promocao.ativa) {
        this.produtrosFiltrados = this.painel.produtos.filter(
          (produto) => produto.promocao_ativa == true
        );
      } else {
        this.produtrosFiltrados = this.painel.produtos;
      }

      this.produtrosFiltrados = this.produtrosFiltrados.filter((produto) => {
        if (produto.promocao_ativa) {
          return (
            produto.promocao.novo_preco >= this.filtro.preco.min &&
            produto.promocao.novo_preco <= this.filtro.preco.max
          );
        } else {
          return (
            produto.preco >= this.filtro.preco.min &&
            produto.preco <= this.filtro.preco.max
          );
        }
      });
    },

    removerFiltros() {
      this.produtrosFiltrados = this.painel.produtos;
      this.filtro.ativo = false;
      this.filtro.preco.min = 0;
      this.filtro.preco.max = 200;
      this.filtro.promocao.ativa = false;
    },
  },
};
</script>

<style scoped>
.box {
  min-height: 70vh;
}

.card-cliente {
  border: 2px solid #379c85;
  border-radius: 15px;
}

.bg-title-card {
  background: #379c85;
}

.data-perfil {
  border-bottom-right-radius: 15px;
  border-bottom-left-radius: 15px;
}

.text-filtro {
  color: #8abbbf;
}
.bg-filtro {
  background: #8abbbf;
}
</style>
