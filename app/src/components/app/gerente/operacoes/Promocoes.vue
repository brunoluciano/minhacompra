<template>
  <div class="q-pa-lg">
    <div class="col">
      <q-table
        class="my-sticky-header-table"
        title="Promoções"
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
            <q-td key="operacoes" :props="props">
              <q-btn
                v-if="props.row.possui_promocao"
                outline
                rounded
                dense
                color="orange"
                icon="edit"
                label="Editar Promoção"
                padding="xs md"
                @click="props.expand = !props.expand"
              />
              <q-btn
                v-else
                outline
                rounded
                dense
                color="teal"
                icon="add"
                label="Nova Promoção"
                padding="xs sm"
                @click="props.expand = !props.expand"
              />
            </q-td>

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
                    {{ props.row.descricao }}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-td>

            <q-td key="preco" :props="props">{{ props.cols[2].value }}</q-td>
            <q-td key="novo_preco" :props="props">{{
              props.cols[3].value
            }}</q-td>
            <q-td key="porcentagem" :props="props">{{
              props.cols[4].value
            }}</q-td>

            <q-td key="promocao_ativa" :props="props">
              <q-btn
                v-if="props.row.promocao_ativa"
                round
                color="green-5"
                icon="mdi-check-outline"
                size="sm"
                @click="ativaDesativaPromocao(false, props.row)"
              />
              <q-btn
                v-else
                round
                color="red-5"
                icon="mdi-close-outline"
                size="sm"
                @click="ativaDesativaPromocao(true, props.row)"
              />
            </q-td>
          </q-tr>
          <q-tr v-show="props.expand" :props="props">
            <q-td colspan="100%">
              <div class="text-subtitle1">
                <b>Promoção: </b>{{ props.row.descricao }}
              </div>
              <div class="row q-pa-sm q-col-gutter-x-md">
                <q-input
                  rounded
                  dense
                  readonly
                  v-model="props.cols[2].value"
                  label="Preço Original"
                  type="text"
                  color="blue-grey-6"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  dense
                  v-model="props.row.promocao.novo_preco"
                  label="Novo Preço"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-4"
                  prefix="R$"
                  v-on:change="ajusteNovoPreco(props.row)"
                />
                <q-input
                  rounded
                  dense
                  v-model="props.row.promocao.porcentagem"
                  label="Porcentagem de Promoção"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-4"
                  suffix="%"
                  v-on:change="ajusteNovaPorcentagem(props.row)"
                />
              </div>
              <q-btn
                rounded
                outline
                dense
                color="teal"
                icon="check"
                label="Aplicar Promoção"
                @click="aplicarPromocao(props.row)"
                class="full-width"
              />
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
          name: "operacoes",
          label: "Operações",
          required: true,
          align: "center",
          sortable: false,
        },
        {
          name: "descricao",
          label: "Descrição",
          field: "descricao",
          required: true,
          align: "center",
          sortable: true,
        },
        {
          name: "preco",
          label: "Preço Original",
          field: "preco",
          align: "center",
          format: (val) => `R$ ${this.formatPrice(val)}`,
          sortable: true,
        },
        {
          name: "novo_preco",
          label: "Novo Preço",
          field: (row) => row.promocao.novo_preco,
          align: "center",
          format: (val) =>
            (val = val != 0 ? `R$ ${this.formatPrice(val)}` : "-"),

          sortable: true,
        },
        {
          name: "porcentagem",
          label: "Porcentagem de Promoção",
          field: (row) => row.promocao.porcentagem,
          align: "center",
          format: (val) => (val = val != 0 ? `${val}%` : "-"),
          sortable: true,
        },
        {
          name: "promocao_ativa",
          label: "Promoção Ativa",
          field: "promocao_ativa",
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
  },

  methods: {
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    voltarDashboard() {
      this.$router.push({ name: "dashboardgerente" });
    },

    abrirModalCadastro() {
      this.modal.cadastro = true;
    },
    fecharModalCadastro(val) {
      this.modal.cadastro = val.target;
    },

    ativaDesativaPromocao(val, prod) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      let update = {
        _method: "PATCH",
        promocao_ativa: val,
      };
      this.$http
        .post(`empresa/${empresa_id}/produto/${prod.id}/update`, update)
        .then(
          (res) => {
            res.json();
            var produtoAlterado = this.produtos.filter(
              (val) => val.id == prod.id
            );
            produtoAlterado[0].promocao_ativa = val;
            this.successNotify(
              `Sucesso ao atualizar status da promoção do produto ${prod.descricao}!`
            );
          },
          (err) => {
            console.log(err);
            this.errorNotify(
              `Erro ao atualizar status da promoção do produto ${prod.descricao}!`
            );
          }
        );
    },

    ajusteNovoPreco(prod) {
      var produto = this.produtos.filter((val) => val.id == prod.id);
      produto = produto[0];
      var ajuste = produto.preco - produto.promocao.novo_preco;
      produto.promocao.porcentagem = parseInt((ajuste * 100) / produto.preco);
    },

    ajusteNovaPorcentagem(prod) {
      var produto = this.produtos.filter((val) => val.id == prod.id);
      produto = produto[0];
      // var ajuste = produto.preco - produto.promocao.novo_preco;
      produto.promocao.novo_preco = (
        produto.preco -
        (produto.preco * produto.promocao.porcentagem) / 100
      ).toFixed(2);
    },

    aplicarPromocao(prod) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      var produto = this.produtos.filter((val) => val.id == prod.id);
      produto = produto[0];
      let update = {
        // _method: "PATCH",
        novo_preco: produto.promocao.novo_preco,
        porcentagem: produto.promocao.porcentagem,
      };
      this.$http
        .put(`empresa/${empresa_id}/produto/${prod.id}/promocao/1`, update)
        .then(
          (res) => {
            res.json();
            this.successNotify(
              `Sucesso ao aplicar promoção do produto ${prod.descricao}!`
            );
          },
          (err) => {
            console.log(err);
            this.errorNotify(
              `Erro ao aplicar promoção do produto ${prod.descricao}!`
            );
          }
        );
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
</style>