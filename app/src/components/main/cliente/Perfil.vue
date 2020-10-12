<template>
  <div class="row q-pa-lg q-col-gutter-x-lg q-col-gutter-y-xl">
    <div class="col-12 col-sm-5 col-md-3">
      <q-card class="card-cliente shadow-5">
        <q-card-section class="bg-title-card text-white q-pa-xs">
          <div class="text-h5 text-center">Nome Cliente</div>
        </q-card-section>
        <q-card-section class="q-pa-none data-perfil">
          <q-list dense class="data-perfil text-blue-grey-5 ellipsis">
            <q-item clickable v-ripple>
              <q-item-section class="text-weight-bold"> CPF </q-item-section>
              <q-item-section class="text-center"
                >123.456.789-12</q-item-section
              >
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section class="text-weight-bold"> E-mail </q-item-section>
              <q-item-section class="text-center"
                >cliente@email.com</q-item-section
              >
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section class="text-weight-bold">
                Telefone
              </q-item-section>
              <q-item-section class="text-center"
                >(99) 987654-3210</q-item-section
              >
            </q-item>

            <q-separator spaced />

            <q-item clickable v-ripple>
              <q-item-section
                ><div>
                  Editar Perfil
                  <q-icon name="fas fa-user-edit q-ml-xs" size="15px" />
                </div>
              </q-item-section>
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section>
                <q-item-label
                  ><div>
                    Sair
                    <q-icon name="fas fa-sign-out-alt q-ml-xs" size="15px" />
                  </div>
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
      </q-card>
    </div>

    <div class="col-12 col-sm-7 col-md-9">
      <div class="row q-col-gutter-x-lg q-col-gutter-y-md">
        <div class="col-12 col-md-4" @click="mostrarListaCompras">
          <card
            :descricao="card.lista_compra.descricao"
            :icone="card.lista_compra.icone"
            :cor="card.lista_compra.cor"
          ></card>
        </div>
        <div class="col-12 col-md-4" @click="mostrarLojasFavoritas">
          <card
            :descricao="card.lojas_favoritas.descricao"
            :icone="card.lojas_favoritas.icone"
            :cor="card.lojas_favoritas.cor"
          ></card>
        </div>
        <div class="col-12 col-md-4" @click="mostrarCartoes">
          <card
            :descricao="card.cartoes.descricao"
            :icone="card.cartoes.icone"
            :cor="card.cartoes.cor"
          ></card>
        </div>
      </div>

      <q-separator color="grey-5" class="q-my-lg" />

      <div class="row">
        <div class="col">
          <q-table title="Últimas Compras" :data="rows" row-key="name" />
        </div>
      </div>

      <modal-lista-compras
        :mostraModal="modal.mostraListaCompras"
        @fecharModal="fecharModalListaCompras"
      ></modal-lista-compras>
      <modal-lojas-favoritas
        :mostraModal="modal.mostraLojasFavoritas"
        @fecharModal="fecharModalLojasFavoritas"
      ></modal-lojas-favoritas>
      <modal-cartoes
        :mostraModal="modal.mostraCartoes"
        @fecharModal="fecharModalCartoes"
      ></modal-cartoes>
    </div>
  </div>
</template>

<script>
import Card from "../../shared/Card.vue";
import ModalListaCompras from "./ModalListaCompras.vue";
import ModalLojasFavoritas from "./ModalLojasFavoritas.vue";
import ModalCartoes from "./ModalCartoes.vue";

export default {
  components: {
    Card,
    ModalListaCompras,
    ModalLojasFavoritas,
    ModalCartoes,
  },

  data() {
    return {
      card: {
        lista_compra: {
          descricao: "Listas de Compras",
          icone: "assignment",
          cor:
            "background: rgb(245,133,83);background: linear-gradient(0deg, rgba(245,133,83,1) 0%, rgba(241,168,135,1) 100%);",
        },
        lojas_favoritas: {
          descricao: "Lojas Favoritas",
          icone: "mdi-store",
          cor:
            "background: rgb(245,83,83);background: linear-gradient(0deg, rgba(245,83,83,1) 0%, rgba(241,135,135,1) 100%);",
        },
        cartoes: {
          descricao: "Meus Cartões",
          icone: "credit_card",
          cor:
            "background: rgb(83,201,245);background: linear-gradient(0deg, rgba(83,201,245,1) 0%, rgba(135,209,241,1) 100%);",
        },
      },
      rows: [
        {
          horario: "##/##/#### ##:##",
          loja: "Supermercado",
          qtd: 10,
          andamento: "Andamento",
          total: "R$ XX,XX",
          detalhes: "+",
        },
      ],
      modal: {
        mostraListaCompras: false,
        mostraLojasFavoritas: false,
        mostraCartoes: false,
      },
    };
  },

  methods: {
    mostrarListaCompras() {
      this.modal.mostraListaCompras = true;
    },
    fecharModalListaCompras(val) {
      this.modal.mostraListaCompras = val.target;
    },
    mostrarLojasFavoritas() {
      this.modal.mostraLojasFavoritas = true;
    },
    fecharModalLojasFavoritas(val) {
      this.modal.mostraLojasFavoritas = val.target;
    },
    mostrarCartoes() {
      this.modal.mostraCartoes = true;
    },
    fecharModalCartoes(val) {
      this.modal.mostraCartoes = val.target;
    },
  },
};
</script>

<style scoped>
.card-cliente {
  border: 2px solid #86afb8;
  border-radius: 15px;
}

.bg-title-card {
  background: #86afb8;
}

.data-perfil {
  border-bottom-right-radius: 15px;
  border-bottom-left-radius: 15px;
}
</style>