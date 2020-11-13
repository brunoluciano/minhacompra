<template>
  <div class="q-pa-lg">
    <!-- <div class="text-h3 text-grey-9">Produtos</div> -->
    <!-- <q-separator class="q-mb-md" /> -->
    <q-btn
      flat
      rounded
      color="grey"
      icon="mdi-undo-variant"
      label="Voltar para Dashboard"
      @click="voltarDashboard"
    />
    <br /><br />
    <div class="col">
      <q-table
        class="my-sticky-header-table"
        title="Produtos"
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
          <q-btn
            rounded
            color="teal-5"
            :disable="loading"
            label="Adicionar Produto"
            icon="add"
            class="q-mr-sm"
            @click="abrirModalCadastro"
          />
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

        <template v-slot:body-cell-descricao="props">
          <q-td :props="props">
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
        </template>
        <template v-slot:body-cell-unidade="props">
          <q-td :props="props">
            {{ props.row.unidade }} {{ props.row.unidade_medida.sigla }}
          </q-td>
        </template>
        <template v-slot:body-cell-promocao_ativa="props">
          <q-td :props="props">
            <q-btn
              v-if="props.row.promocao_ativa"
              round
              color="green-5"
              icon="mdi-check-outline"
              size="sm"
            />
            <q-btn
              v-else
              round
              color="red-5"
              icon="mdi-close-outline"
              size="sm"
            />
          </q-td>
        </template>
        <template v-slot:loading>
          <q-inner-loading showing color="teal" />
        </template>
      </q-table>
    </div>

    <!-- MODAL CADASTRO PRODUTO -->
    <cadastrar-produto
      :mostraModal="modal.cadastro"
      @fecharModal="fecharModalCadastro"
    />
  </div>
</template>

<script>
import CadastrarProduto from "./modal/CadastrarProduto.vue";

export default {
  components: {
    CadastrarProduto,
  },

  data() {
    return {
      produtos: [],
      columns: [
        // array of Objects
        // column Object definition
        {
          // unique id
          // identifies column
          // (used by pagination.sortBy, "body-cell-[name]" slot, ...)
          name: "descricao",

          // label for header
          label: "Descrição",

          // row Object property to determine value for this column
          field: "descricao",
          // OR field: row => row.some.nested.prop,

          // (optional) if we use visible-columns, this col will always be visible
          required: true,

          // (optional) alignment
          align: "center",

          // (optional) tell QTable you want this column sortable
          sortable: true,
        },
        {
          name: "preco",
          label: "Preço",
          field: "preco",
          align: "center",
          format: (val) => `R$ ${this.formatPrice(val)}`,
          sortable: true,
        },
        {
          name: "departamento",
          label: "Departamento",
          field: (row) => row.departamento.descricao,
          align: "center",
          sortable: true,
        },
        {
          name: "categoria",
          label: "Categoria",
          field: (row) => row.categoria.descricao,
          align: "center",
          sortable: true,
        },
        {
          name: "marca",
          label: "Marca",
          field: (row) => row.marca.descricao,
          align: "center",
          sortable: true,
        },
        {
          name: "unidade_medida",
          label: "Unidade de Medida",
          field: (row) => row.unidade_medida.descricao,
          align: "center",
          sortable: true,
        },
        {
          name: "unidade",
          label: "Unidade",
          field: "unidade",
          align: "center",
          sortable: true,
        },
        {
          name: "cod_barras",
          label: "Código de Barras",
          field: "cod_barras",
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_minimo",
          label: "Estoque Mínimo",
          field: "estoque_minimo",
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_atual",
          label: "Estoque Atual",
          field: "estoque_atual",
          align: "center",
          sortable: true,
        },
        {
          name: "estoque_maximo",
          label: "Estoque Máximo",
          field: "estoque_maximo",
          align: "center",
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
  },
};
</script>

<style lang="sass">
@import url("https://fonts.googleapis.com/css2?family=Oswald&display=swap")

.text-table-title
  font-family: "Oswald", sans-serif !important

.text-header-bold
  font-weight: bold !important

.image-card
  display: block
  -moz-transition: all 0.5s
  -webkit-transition: all 0.5s
  transition: all 0.5s

.my-sticky-header-table
  /* height or max-height is important */
  max-height: 70vh

  thead tr th
    position: sticky
    z-index: 1
  thead tr:first-child th
    top: 0

  /* this is when the loading indicator appears */
  &.q-table--loading thead tr:last-child th
    /* height of all previous header rows */
    top: 48px
</style>