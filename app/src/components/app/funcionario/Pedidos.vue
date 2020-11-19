<template>
  <q-markup-table class="text-center">
    <thead>
      <tr class="bg-blue-grey-5">
        <th colspan="5">
          <div class="row">
            <div class="text-h4 q-ml-sm text-white text-weight-bold">
              Pedidos
            </div>
          </div>
        </th>
      </tr>
      <tr class="bg-grey-4 text-weight-bold text-grey-9">
        <td>Horário</td>
        <td>Cliente</td>
        <td>Produtos Comprados</td>
        <td>Total da Compra</td>
        <td>Separar Pedido</td>
      </tr>
    </thead>
    <tbody class="bg-grey-1">
      <tr v-for="pedido in pedidos" :key="pedido">
        <td>{{ pedido.horario }}</td>
        <td>{{ pedido.pessoa.nome }}</td>
        <td>{{ pedido.qtd_itens }} itens</td>
        <td>R$ {{ pedido.total_venda }}</td>
        <td>
          <q-icon
            name="mdi-basket-plus"
            size="2rem"
            color="blue-grey"
            class="cursor-pointer"
            @click="separarPedido(pedido.id)"
          />
        </td>
      </tr>
    </tbody>
  </q-markup-table>
</template>

<script>
export default {
  data() {
    return {
      pedidos: {},
    };
  },
  created() {
    window.setTimeout(() => {
      let empresa_id = this.$store.state.usuario.empresa.id;
      this.$http
        .get(`empresa/${empresa_id}/venda`)
        .then((res) => res.json())
        .then(
          (pedidos) => {
            this.pedidos = pedidos;
            console.log(this.pedidos);
          },
          (err) => console.log(err)
        );
    }, 1000);
  },

  methods: {
    separarPedido(pedido) {
      this.$router.push({
        name: "separarpedido",
        params: {
          pedido: pedido,
        },
      });
    },
  },
};
</script>

<style>
</style>