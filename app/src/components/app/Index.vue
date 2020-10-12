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
};
</script>

<style scoped>
</style>