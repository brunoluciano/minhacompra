<template>
  <div class="corpo">
    <!-- <main-menu> -->
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
    <!-- </main-menu> -->
  </div>
</template>

<script>
// import MainMenu from "./components/layout/MainMenu.vue";

export default {
  components: {
    // MainMenu,
  },

  created() {
    document.title = "Minha Compra";
  },
};
</script>

<style scoped>
.corpo {
  margin: 0 auto;
}

.fade-enter-active,
.fade-leave-active {
  transition-duration: 0.2s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}
</style>
