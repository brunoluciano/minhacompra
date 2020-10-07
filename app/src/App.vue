<template>
  <div>
    <transition name="pagina">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
// import LayoutComponent from "./components/MainLayout.vue";

export default {};
</script>

<style scoped>
.pagina-enter,
.pagina-leave-active {
  height: 0;
  opacity: 0;
}
.pagina-enter-active,
.pagina-leave-active {
  transition: opacity 1s ease;
}
</style>
