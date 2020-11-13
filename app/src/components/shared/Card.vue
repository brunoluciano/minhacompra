<template>
  <div>
    <q-card class="card text-white shadow-5" :style="cor" @click="redirectTo">
      <q-card-section horizontal v-ripple.early>
        <q-card-section class="q-pr-none q-ml-sm ellipsis-3-lines">
          <div class="text-h5 text-weight-bold">{{ descricao }}</div>
        </q-card-section>

        <q-card-section class="right">
          <q-icon :name="icone" size="5rem" />
        </q-card-section>
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
export default {
  props: ["descricao", "icone", "cor", "link"],

  methods: {
    redirectTo() {
      // alert(this.link);
      this.$router.push({ name: this.link });
    },
  },
};
</script>

<style scoped>
.card {
  transition: ease 0.3s;
  border-radius: 30px;
}

.card:hover {
  cursor: pointer;
  transition: ease 0.3s;
  -moz-transform: scale(1.08);
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
  overflow: hidden;
  box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.6), 0 5px 8px rgba(0, 0, 0, 0.16),
    0 1px 14px rgba(0, 0, 0, 0.14);
}
</style>