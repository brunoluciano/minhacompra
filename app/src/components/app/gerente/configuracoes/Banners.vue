<template>
  <div class="q-pa-lg">
    <div class="col">
      <q-table
        class="my-sticky-header-table"
        title="Banners"
        :data="banners"
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
            label="Adicionar Banner"
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
            placeholder="Buscar por banner"
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
                outline
                rounded
                dense
                color="red"
                icon="delete"
                label="Remover"
                padding="xs sm"
                class="full-width"
                @click="removerBanner(props.row)"
              />
            </q-td>
            <q-td key="imagem" :props="props">
              <q-img
                :src="props.row.img"
                spinner-color="teal"
                style="height: 300px; width: 100%"
                :ratio="1"
              />
            </q-td>

            <q-td key="descricao" :props="props"
              >{{ props.row.descricao }}
              <q-popup-edit
                v-model="props.row.descricao"
                title="Atualizar Descrição"
                color="teal"
                buttons
                persistent
                label-set="Confirmar"
                @save="
                  atualizarBanner(
                    props.row.descricao,
                    props.row.ativo,
                    props.row
                  )
                "
                :validate="() => !$refs.descricaoInput.hasError"
              >
                <q-input
                  ref="descricaoInput"
                  type="text"
                  v-model="props.row.descricao"
                  dense
                  autofocus
                  color="teal"
                  :rules="[(val) => val != '' || `Descrição inválida!`]"
                />
              </q-popup-edit>
            </q-td>

            <q-td key="ativo" :props="props">
              <q-btn
                v-if="props.row.ativo"
                round
                color="green-5"
                icon="mdi-check-outline"
                size="sm"
                @click="atualizarBanner(props.row.descricao, false, props.row)"
              />
              <q-btn
                v-else
                round
                color="red-5"
                icon="mdi-close-outline"
                size="sm"
                @click="atualizarBanner(props.row.descricao, true, props.row)"
              />
            </q-td>
          </q-tr>
        </template>

        <template v-slot:loading>
          <q-inner-loading showing color="teal" />
        </template>
      </q-table>
    </div>

    <!-- MODAL CADASTRO BANNER -->
    <cadastrar-banner
      :mostraModal="modal.cadastro"
      @fecharModal="fecharModalCadastro"
      @bannerAdicionado="bannerAdicionadoCadastro"
    />
  </div>
</template>

<script>
import CadastrarBanner from "./modal/CadastrarBanner.vue";

export default {
  components: {
    CadastrarBanner,
  },

  data() {
    return {
      banners: [],
      columns: [
        {
          name: "operacoes",
          label: "Operações",
          required: true,
          align: "center",
        },
        {
          name: "imagem",
          label: "Imagem",
          field: "imagem_url",
          required: true,
          align: "center",
          headerStyle: "min-width: 800px",
          //   sortable: true,
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
          name: "ativo",
          label: "Banner Ativo",
          field: "ativo",
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
        .get(`empresa/${empresa_id}/images/banner`)
        .then((res) => res.json())
        .then(
          (banners) => {
            this.banners = banners;
            this.banners.forEach((banner) => {
              banner.img = `${this.$http.options.root}/empresa/${empresa_id}/images/banner/${banner.id}/img`;
            });
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

    atualizarBanner(descricao, ativo, banner) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      let update = {
        _method: "PATCH",
        descricao: descricao,
        ativo: ativo,
      };
      this.$http
        .post(`empresa/${empresa_id}/images/banner/${banner.id}/update`, update)
        .then(
          (res) => {
            res.json();
            var bannerAlterado = this.banners.filter(
              (val) => val.id == banner.id
            );
            bannerAlterado[0].descricao = descricao;
            bannerAlterado[0].ativo = ativo;
            this.successNotify(
              `Sucesso ao atualizar dados do banner ${banner.descricao}!`
            );
          },
          (err) => {
            console.log(err);
            this.errorNotify(
              `Erro ao atualizar dados do banner ${banner.descricao}!`
            );
          }
        );
    },

    bannerAdicionadoCadastro(val) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      val.img = `${this.$http.options.root}/empresa/${empresa_id}/images/banner/${val.id}/img`;
      this.banners.push(val);
    },

    removerBanner(banner) {
      let empresa_id = this.$store.state.usuario.empresa.id;
      this.$http
        .delete(`empresa/${empresa_id}/images/banner/${banner.id}`)
        .then(
          (res) => {
            res.json();
            let indice = this.banners.findIndex((x) => x.id == banner.id);
            this.banners = [
              ...this.banners.slice(0, indice),
              ...this.banners.slice(indice + 1),
            ];
            this.successNotify(
              `Sucesso ao remover banner ${banner.descricao}!`
            );
          },
          (err) => {
            console.log(err);
            this.errorNotify(`Erro ao remover banner ${banner.descricao}!`);
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

.my-sticky-header-table {
  max-height: 75vh;
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