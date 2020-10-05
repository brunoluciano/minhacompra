<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated class="glossy">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          aria-label="Menu"
          icon="menu"
        />

        <q-toolbar-title> Minha Compra </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <layout-component></layout-component>
    </q-page-container>
  </q-layout>
</template>

<script>
import LayoutComponent from "./components/MainLayout.vue";

export default {
  name: "LayoutDefault",

  components: {
    LayoutComponent,
  },

  data() {
    return {
      leftDrawerOpen: false,
    };
  },
};
</script>

<style>
</style>
