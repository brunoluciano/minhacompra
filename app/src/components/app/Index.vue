<template>
  <div>
    <app-menu>
      <router-view></router-view>
    </app-menu>
  </div>
</template>

<script>
import AppMenu from "../layout/AppMenu.vue";

export default {
  components: {
    AppMenu,
  },

  created() {
    this.$store.commit("login");
  },
};
</script>

<style scoped>
</style>