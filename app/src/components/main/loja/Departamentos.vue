<template>
  <div>
    <q-btn
      rounded
      color="departamentos"
      icon="list"
      label="Departamentos"
      class="full-width"
      @click="onClick"
    />
    <q-list
      bordered
      separator
      class="shadow-2 list-departamentos rounded-bottoms"
    >
      <q-item
        clickable
        v-ripple:indigo
        v-for="departamento in departamentos"
        :key="departamento.id"
      >
        <q-item-section>{{ departamento.descricao }}</q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script>
export default {
  props: ["idEmpresa"],

  data() {
    return {
      departamentos: [],
    };
  },

  created() {
    this.$http
      .get(`empresa/${this.idEmpresa}/departamento`)
      .then((res) => res.json())
      .then(
        (departamentos) => {
          this.departamentos = departamentos;
        },
        (err) => console.log(err)
      );
  },
};
</script>

<style scoped>
.bg-departamentos {
  background: #2970a4;
}

.list-departamentos {
  margin: -5px 10px 0px 10px;
}

.rounded-bottoms {
  border-bottom-right-radius: 20px;
  border-bottom-left-radius: 20px;
}
</style>