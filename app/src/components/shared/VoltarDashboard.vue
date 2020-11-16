<template>
  <div>
    <q-btn
      flat
      rounded
      color="grey"
      icon="mdi-undo-variant"
      label="Voltar para Dashboard"
      @click="voltarDashboard"
      class="q-ml-lg q-mt-lg q-mb-none"
    />
  </div>
</template>

<script>
export default {
  methods: {
    voltarDashboard() {
      this.$router.push({ name: "dashboardgerente" });
    },
  },
};
</script>

<style>
</style>