<template>
  <div class="corpo">
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
import { QSpinnerPuff } from "quasar";

export default {
  data() {
    return {
      carregando: true,
    };
  },

  created() {
    document.title = "Minha Compra";
    // this.$q.loading.show();
    this.$q.loading.show({
      spinner: QSpinnerPuff,
      spinnerColor: "white",
      backgroundColor: "blue-grey",
    });
  },

  mounted() {
    this.timer = setTimeout(() => {
      this.$q.loading.hide();
      this.timer = void 0;
    }, 800);
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
