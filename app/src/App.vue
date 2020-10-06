<template>
  <div>
    <main-menu>
      <div class="row">
        <div class="col-12"></div>
      </div>
    </main-menu>
  </div>
</template>

<script>
// import LayoutComponent from "./components/MainLayout.vue";
import MainMenu from "./components/layout/MainMenu.vue";

export default {
  name: "LayoutDefault",

  components: {
    // LayoutComponent,
    MainMenu,
  },

  data() {
    return {
      leftDrawerOpen: false,
    };
  },
};
</script>

<style scoped>
</style>
