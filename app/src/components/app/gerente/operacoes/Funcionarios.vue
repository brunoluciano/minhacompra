<template>
  <div class="q-pa-lg">
    <!-- <q-btn
      flat
      rounded
      color="grey"
      icon="mdi-undo-variant"
      label="Voltar para Dashboard"
      @click="voltarDashboard"
    /> -->
    <!-- <br /><br /> -->
    <div class="col">
      <q-table
        class="my-sticky-header-table"
        title="Funcionários"
        :data="funcionarios"
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
            label="Adicionar Funcionário"
            icon="add"
            @click="abrirModalCadastro"
            class="q-mr-sm"
          />
          <q-input
            rounded
            outlined
            standout
            dense
            v-model="filter"
            debounce="200"
            color="teal-4"
            placeholder="Buscar por funcionário"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>
        <template v-slot:loading>
          <q-inner-loading showing color="teal" />
        </template>
      </q-table>
    </div>

    <!-- MODAL CADASTRO PRODUTO -->
    <cadastrar-funcionario
      :mostraModal="modal.cadastro"
      @fecharModal="fecharModalCadastro"
    />
  </div>
</template>

<script>
import CadastrarFuncionario from "./modal/CadastrarFuncionario.vue";

export default {
  components: {
    CadastrarFuncionario,
  },

  data() {
    return {
      produtos: [],
      columns: [
        {
          name: "nome",
          label: "Nome",
          field: "nome",
          align: "center",
          sortable: true,
        },
        {
          name: "email",
          label: "E-mail",
          field: "email",
          align: "center",
          sortable: true,
        },
        {
          name: "tipo_usuario",
          label: "Cargo",
          field: (row) => row.tipo_usuario.descricao,
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
        .get(`empresa/${empresa_id}/usuario`)
        .then((res) => res.json())
        .then(
          (funcionarios) => {
            this.funcionarios = funcionarios;
            this.loading = false;
          },
          (err) => console.log(err)
        );
    }, 1000);
  },

  methods: {
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