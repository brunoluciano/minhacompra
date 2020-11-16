<template>
  <div class="q-pa-lg">
    <div class="row q-col-gutter-x-lg q-col-gutter-y-lg items-center">
      <div class="col-12 col-sm-4 col-md-4">
        <q-img
          :src="empresa.imgUrl"
          spinner-color="indigo"
          spinner-size="82px"
          transition="jump-up"
          :ratio="4 / 3"
        />
      </div>
      <div class="col-12 col-sm-8 col-md-8">
        <div
          class="text-h2 text-uppercase text-weight-bold text-grey-8 ellipsis"
        >
          {{ empresa.nome }}
        </div>
        <div class="text-subtitle1">
          {{ empresa.endereco }}, {{ empresa.numero }} - {{ empresa.bairro }},
          {{ empresa.cidade }} - {{ empresa.estado.sigla }}
        </div>
        <q-separator spaced color="white" />
        <q-btn
          rounded
          color="blue-grey-5"
          icon="edit"
          label="Editar Informações"
          @click="onClick"
          class="q-px-md"
        />
      </div>
    </div>

    <q-separator color="grey-5" class="q-my-lg" />
    <div class="row q-pa-none q-col-gutter-x-lg q-col-gutter-y-md">
      <div class="col-12 text-h4 text-grey-8 text-weight-bold">Vendas</div>
      <div
        class="col-12 col-sm-6 col-md-3"
        v-for="card in card.vendas"
        :key="card.vendas"
      >
        <card
          :descricao="card.descricao"
          :icone="card.icone"
          :cor="card.cor"
          :link="card.link"
        ></card>
      </div>
    </div>
    <br /><br />
    <div class="row q-pa-none q-col-gutter-x-lg q-col-gutter-y-md">
      <div class="col-12 text-h4 text-grey-8 text-weight-bold">Operações</div>
      <div
        class="col-12 col-sm-6 col-md-3"
        v-for="card in card.operacoes"
        :key="card.vendas"
      >
        <card
          :descricao="card.descricao"
          :icone="card.icone"
          :cor="card.cor"
          :link="card.link"
        ></card>
      </div>
    </div>
    <br /><br />
    <div class="row q-pa-none q-col-gutter-x-lg q-col-gutter-y-md">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="text-h4 text-grey-8 text-weight-bold q-mb-md">Estoque</div>
        <card
          :descricao="card.estoque.descricao"
          :icone="card.estoque.icone"
          :cor="card.estoque.cor"
          :link="card.estoque.link"
        ></card>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="text-h4 text-grey-8 text-weight-bold q-mb-md">
          Relatórios
        </div>
        <card
          :descricao="card.relatorios.descricao"
          :icone="card.relatorios.icone"
          :cor="card.relatorios.cor"
          :link="card.relatorios.link"
        ></card>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="text-h4 text-grey-8 text-weight-bold q-mb-md">
          Configurações
        </div>
        <card
          :descricao="card.configuracoes.descricao"
          :icone="card.configuracoes.icone"
          :cor="card.configuracoes.cor"
          :link="card.configuracoes.link"
        ></card>
      </div>
    </div>
  </div>
</template>

<script>
import Card from "../../shared/Card.vue";

export default {
  data() {
    return {
      card: {
        vendas: [
          {
            descricao: "Pedidos Recebidos",
            icone: "playlist_add",
            cor:
              "background: rgb(246,208,82);background: linear-gradient(0deg, rgba(246,208,82,1) 0%, rgba(244,217,115,1) 100%);",
          },
          {
            descricao: "Separados para Entrega",
            icone: "playlist_add_check",
            cor:
              "background: rgb(83,201,245);background: linear-gradient(0deg, rgba(83,201,245,1) 0%, rgba(135,209,241,1) 100%);",
          },
          {
            descricao: "Pedidos a Caminho",
            icone: "mdi-truck-fast-outline",
            cor:
              "background: rgb(83,90,245);background: linear-gradient(0deg, rgba(83,90,245,1) 0%, rgba(135,143,241,1) 100%);",
          },
          {
            descricao: "Pedidos Entregue",
            icone: "mdi-truck-check-outline",
            cor:
              "background: rgb(63,171,59);background: linear-gradient(0deg, rgba(63,171,59,1) 0%, rgba(94,150,97,1) 100%);",
          },
        ],
        operacoes: [
          {
            descricao: "Produtos",
            icone: "mdi-package-variant-closed",
            cor:
              "background: rgb(245,133,83);background: linear-gradient(0deg, rgba(245,133,83,1) 0%, rgba(241,168,135,1) 100%);",
            link: "produtosempresa",
          },
          {
            descricao: "Funcionários",
            icone: "mdi-account-group",
            cor:
              "background: rgb(245,83,83);background: linear-gradient(0deg, rgba(245,83,83,1) 0%, rgba(241,135,135,1) 100%);",
            link: "funcionariosempresa",
          },
          {
            descricao: "Definir Promoções",
            icone: "mdi-check-decagram",
            cor:
              "background: rgb(142,83,245);background: linear-gradient(0deg, rgba(142,83,245,1) 0%, rgba(174,135,241,1) 100%);",
            link: "promocoes",
          },
        ],
        estoque: {
          descricao: "Gerenciar Estoque",
          icone: "mdi-database",
          cor:
            "background: rgb(172,172,172);background: linear-gradient(0deg, rgba(172,172,172,1) 0%, rgba(226,226,226,1) 100%);",
        },
        relatorios: {
          descricao: "Gerar Relatórios",
          icone: "mdi-file-chart",
          cor:
            "background: rgb(210,89,171);background: linear-gradient(0deg, rgba(210,89,171,1) 0%, rgba(233,120,187,1) 100%);",
        },
        configuracoes: {
          descricao: "Editar Banners",
          icone: "mdi-view-carousel",
          cor:
            "background: rgb(89,210,131);background: linear-gradient(0deg, rgba(89,210,131,1) 0%, rgba(120,233,159,1) 100%);",
        },
      },

      user: {},
      empresa: {},
    };
  },

  created() {
    window.setTimeout(() => {
      this.empresa = this.$store.state.usuario.empresa;
    }, 500);
  },

  components: {
    Card,
  },
};
</script>

<style scoped>
</style>