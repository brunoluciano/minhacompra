<template>
  <div>
    <menu-lateral></menu-lateral>

    <q-page class="q-px-lg q-py-md">
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
            <td>Separar Pedido</td>
          </tr>
        </thead>
        <tbody class="bg-grey-1">
          <tr v-for="n in 10" :key="n">
            <td>XX/XX/XXXX • XX:XX</td>
            <td>Fulano de Tal</td>
            <td>XX itens</td>
            <td>
              <q-icon
                name="mdi-basket-plus"
                size="2rem"
                color="blue-grey"
                class="cursor-pointer"
              />
            </td>
          </tr>
        </tbody>
      </q-markup-table>
    </q-page>
  </div>
</template>

<script>
import MenuLateral from "../../shared/MenuLateral.vue";

export default {
  data() {
    return {
      drawer: false,
      miniState: false,
    };
  },

  components: {
    MenuLateral,
  },
};
</script>

<style scoped>
</style>