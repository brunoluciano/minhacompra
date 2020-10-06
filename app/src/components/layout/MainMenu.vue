<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-gradient-menu text-white">
      <q-toolbar>
        <q-toolbar-title>
          <h4 class="q-ma-sm">
            <q-icon name="mdi-cart-variant" size="auto"></q-icon>
            Minha Compra
          </h4>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <slot></slot>
    </q-page-container>

    <q-footer elevated class="bg-dark text-white">
      <q-toolbar> </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
export default {
  name: "main-menu",
};
</script>

<style scoped>
.bg-gradient-menu {
  background: rgb(73, 179, 167);
  background: -moz-linear-gradient(
    90deg,
    rgba(73, 179, 167, 1) 0%,
    rgba(45, 167, 122, 1) 100%
  );
  background: -webkit-linear-gradient(
    90deg,
    rgba(73, 179, 167, 1) 0%,
    rgba(45, 167, 122, 1) 100%
  );
  background: linear-gradient(
    90deg,
    rgba(73, 179, 167, 1) 0%,
    rgba(45, 167, 122, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#49b3a7",endColorstr="#2da77a",GradientType=1);
}
</style>