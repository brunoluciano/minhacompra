<template>
  <div>
    <q-table
      title="Treats"
      :data="data"
      :columns="columns"
      row-key="name"
      :selected-rows-label="getSelectedString"
      selection="multiple"
      :selected.sync="selected"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      selected: [],
    };
  },

  created() {
    window.setTimeout(() => {
      this.empresa = this.$store.state.usuario.empresa;
      this.$http
        .get(`empresa/${this.empresa.id}`)
        .then((res) => res.json())
        .then((empresa) => {
          this.empresa = empresa;
          let url = `${this.$http.options.root}/empresa/${this.empresa.id}/images/logo`;
          this.empresa.imgUrl = url;
        }),
        (err) => {
          console.log(err);
        };
    }, 1000);
  },
};
</script>

<style>
</style>