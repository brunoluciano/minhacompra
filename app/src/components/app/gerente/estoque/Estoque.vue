<template>
  <div class="q-pa-lg">
    <div class="col">
      <q-table
        class="my-sticky-header-table"
        title="Estoque"
        :data="produtos"
        :columns="columns"
        row-key="descricao"
        :filter="filter"
        :loading="loading"
        card-class="bg-blue-grey-2"
        table-class="bg-grey-1 text-grey-9"
        title-class="text-h4 text-grey-9 text-table-title"
        table-header-class="bg-blue-grey-4 text-white text-italic text-header-bold"
      >
        <template v-slot:top-right>
          <q-input
            rounded
            outlined
            standout
            dense
            v-model="filter"
            debounce="200"
            color="teal-4"
            placeholder="Buscar por produto"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>

        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td key="descricao" :props="props">
              <q-item>
                <q-item-section avatar>
                  <q-avatar class="shadow-3 bg-white" size="60px">
                    <q-img
                      :src="props.row.imgUrl"
                      transition="fade"
                      spinner-color="grey"
                      class="image-card"
                    />
                  </q-avatar>
                </q-item-section>
                <q-item-section>
                  <q-item-label>
                    {{ props.row.descricao }} •
                    {{ props.row.marca.descricao }} •
                    {{ props.row.unidade }}
                    {{ props.row.unidade_medida.sigla }}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-td>

            <q-td key="estoque_minimo" :props="props"
              >{{ props.row.estoque_minimo }}
              <q-popup-edit
                v-model="props.row.estoque_minimo"
                title="Atualizar Estoque Mínimo"
                color="teal"
                buttons
                persistent
                label-set="Confirmar"
                @save="atualizarEstoque(props.row)"
                :validate="() => !$refs.minimoInput.hasError"
              >
                <q-input
                  ref="minimoInput"
                  type="number"
                  v-model="props.row.estoque_minimo"
                  dense
                  autofocus
                  color="teal"
                  :rules="[
                    (val) =>
                      (val > 0 &&
                        val <= props.row.estoque_atual &&
                        val < props.row.estoque_maximo) ||
                      `Valor inválido!`,
                  ]"
                />
              </q-popup-edit>
            </q-td>
            <q-td key="estoque_atual" :props="props"
              ><q-badge
                :class="feedbackEstoqueAtual(props.row)"
                class="q-px-sm q-py-xs shadow-2"
                text-color="white"
                :label="props.row.estoque_atual"
              />

              <q-popup-edit
                v-model="props.row.estoque_atual"
                title="Atualizar Estoque Atual"
                color="teal"
                buttons
                persistent
                label-set="Confirmar"
                @save="atualizarEstoque(props.row)"
                :validate="() => !$refs.atualInput.hasError"
              >
                <q-input
                  ref="atualInput"
                  type="number"
                  v-model="props.row.estoque_atual"
                  dense
                  autofocus
                  color="teal"
                  :rules="[
                    (val) =>
                      (val >= props.row.estoque_minimo &&
                        val <= props.row.estoque_maximo) ||
                      `Valor inválido!`,
                  ]"
                />
              </q-popup-edit>
            </q-td>
            <q-td key="estoque_maximo" :props="props"
              >{{ props.row.estoque_maximo }}
              <q-popup-edit
                v-model="props.row.estoque_maximo"
                title="Atualizar Estoque Máximo"
                color="teal"
                buttons
                persistent
                label-set="Confirmar"
                @save="atualizarEstoque(props.row)"
                :validate="() => !$refs.maximoInput.hasError"
              >
                <q-input
                  ref="maximoInput"
                  type="number"
                  v-model="props.row.estoque_maximo"
                  dense
                  autofocus
                  color="teal"
                  :rules="[
                    (val) =>
                      (val > props.row.estoque_minimo &&
                        val >= props.row.estoque_atual) ||
                      `Valor inválido!`,
                  ]"
                />
              </q-popup-edit>
            </q-td>
          </q-tr>
        </template>

        <template v-slot:loading>
          <q-inner-loading showing color="teal" />
        </template>
      </q-table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      produtos: [],
      columns: [
        {
          name: "descricao",
          label: "Descrição",
          field: "descricao",
          required: true,
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_minimo",
          label: "Estoque Mínimo",
          field: "estoque_minimo",
          required: true,
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_atual",
          label: "Estoque Atual",
          field: "estoque_atual",
          required: true,
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_maximo",
          label: "Estoque Máximo",
          field: "estoque_maximo",
          required: true,
          align: "center",
          sortable: true,
        },
      ],
      loading: true,
      filter: "",
      modal: {
        cadastro: false,
      },
    };
  },

  created() {
    window.setTimeout(() => {
      let empresa_id = this.$store.state.usuario.empresa.id;
      this.$http
        .get(`empresa/${empresa_id}/produto`)
        .then((res) => res.json())
        .then(
          (produtos) => {
            this.produtos = produtos;
            this.produtos.forEach((produto) => {
              produto.imgUrl = `${this.$http.options.root}/empresa/${produto.empresa.id}/images/produto/${produto.id}`;
              if (produto.promocao == null) {
                let promocao = {
                  novo_preco: 0,
                  porcentagem: 0,
                };
                produto.promocao = promocao;
                produto.possui_promocao = false;
              } else {
                produto.possui_promocao = true;
              }
            });
            this.loading = false;
          },
          (err) => console.log(err)
        );
    }, 1000);
  },

  methods: {
    atualizarEstoque(prod) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      let update = {
        _method: "PATCH",
        estoque_minimo: prod.estoque_minimo,
        estoque_atual: prod.estoque_atual,
        estoque_maximo: prod.estoque_maximo,
      };
      this.$http
        .post(`empresa/${empresa_id}/produto/${prod.id}/update`, update)
        .then(
          (res) => {
            res.json();
            this.successNotify(
              `Sucesso ao atualizar parâmetros de estoque do produto ${prod.descricao}!`
            );
          },
          (err) => {
            console.log(err);
            this.errorNotify(
              `Erro ao atualizar parâmetros de estoque do produto ${prod.descricao}!`
            );
          }
        );
    },

    feedbackEstoqueAtual(props) {
      let minimo = props.estoque_minimo;
      let atual = props.estoque_atual;
      let maximo = props.estoque_maximo;

      let meio = minimo + (maximo - minimo) / 2;
      let meioQuarto = meio / 2;
      let cor;

      if (atual >= meio + meioQuarto) {
        cor = "blue";
      } else if (atual >= meio && atual <= meio + meioQuarto) {
        cor = "green";
      } else if (atual >= meioQuarto && atual <= meio) {
        cor = "yellow";
      } else {
        cor = "red";
      }

      return cor;
    },

    successNotify(msg) {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "positive",
        message: msg,
      });
    },
    errorNotify(msg) {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: msg,
      });
    },
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Oswald&display=swap");

.text-table-title {
  font-family: "Oswald", sans-serif !important;
}

.text-header-bold {
  font-weight: bold !important;
}

.image-card {
  display: block;
  -moz-transition: all 0.5s;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}

.my-sticky-header-table {
  max-height: 70vh;
}

.my-sticky-header-table thead tr th {
  position: sticky;
  z-index: 1;
}
.my-sticky-header-table thead tr:first-child th {
  top: 0;
}

.blue {
  background: #2196F3;
}
.green {
  background: #43A047;
}
.yellow {
  background: #FFA726;
}
.red {
  background: #EF5350;
}
</style>