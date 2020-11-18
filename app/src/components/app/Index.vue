<template>
  <div>
    <app-menu>
      <voltar-dashboard
        v-if="$route.name != 'dashboardgerente' && $route.name != 'dashboardfuncionario'"
      ></voltar-dashboard>
      <router-view></router-view>
    </app-menu>
  </div>
</template>

<script>
import AppMenu from "../layout/AppMenu.vue";
import VoltarDashboard from "../shared/VoltarDashboard.vue";

export default {
  components: {
    AppMenu,
    VoltarDashboard,
  },

  created() {
    this.$store.commit("login");
  },
};
</script>

<style scoped>
</style>