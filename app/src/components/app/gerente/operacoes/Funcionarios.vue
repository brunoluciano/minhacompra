<template>
  <div class="q-pa-lg">
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
            @click="addRow"
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
  </div>
</template>

<script>
export default {
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
    };
  },

  created() {
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
  },

  methods: {
    voltarDashboard() {
      this.$router.push({ name: "dashboardgerente" });
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
</style>