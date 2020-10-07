<template>
  <div>
    <h1>Buscar por Lojas</h1>
    <router-link :to="{ name: 'home' }">
      <q-btn
        class="q-mb-sm"
        color="primary"
        icon="location_on"
        label="Encontrar lojas próximas"
        @click="onClick"
      />
    </router-link>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>