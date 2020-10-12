<template>
  <div>
    <main-menu>
      <router-view></router-view>
    </main-menu>
  </div>
</template>

<script>
import MainMenu from "../../layout/MainMenu.vue";

export default {
  components: {
    MainMenu,
  },
};
</script>

<style scoped>
</style>