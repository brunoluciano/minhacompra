<template>
  <div>
    <q-dialog v-model="mostraModal" persistent>
      <q-card class="card q-pa-md">
        <q-card-section>
          <div class="text-h3 text-teal-8">Cadastrar Funcionário</div>
          <q-separator />
        </q-card-section>

        <q-card-section class="row q-pt-none">
          <div class="col">
            <q-form @submit.prevent="onSubmit">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-input
                  rounded
                  outlined
                  v-model="usuario.nome"
                  label="Nome"
                  type="text"
                  color="blue-grey-6"
                  class="col-12 col-md-6"
                />
                <q-input
                  rounded
                  outlined
                  v-model="usuario.email"
                  label="E-mail"
                  type="email"
                  color="blue-grey-6"
                  class="col-12 col-md-6"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model.number="usuario.password"
                  label="Senha"
                  type="password"
                  color="blue-grey-6"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="usuario.cnfPassword"
                  label="Confirmar Senha"
                  type="password"
                  color="blue-grey-6"
                  class="col-12 col-md-4"
                />
                <q-select
                  rounded
                  outlined
                  v-model="usuario.tipo_usuario_id"
                  :options="options.cargos"
                  option-label="descricao"
                  option-value="id"
                  label="Cargo"
                  emit-value
                  map-options
                  color="blue-grey-6"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-4"
                />
              </div>

              <br />
              <div class="q-mt-sm">
                <q-btn-group rounded spread>
                  <q-btn
                    rounded
                    label="Confirmar"
                    type="submit"
                    color="secondary"
                    v-close-popup
                  />
                  <q-btn
                    outline
                    rounded
                    label="Cancelar"
                    type="reset"
                    color="grey"
                    v-close-popup
                  />
                </q-btn-group>
              </div>
            </q-form>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import Usuario from "../../../../../domain/usuario/Usuario";

export default {
  props: ["mostraModal"],

  data() {
    return {
      usuario: new Usuario(),
      options: {
        cargos: [],
      },
    };
  },

  watch: {
    mostraModal: function () {
      if (!this.mostraModal) {
        this.$emit("fecharModal", this.mostraModal);
      }
    },
  },

  created() {
    this.$http
      .get("tipousuario")
      .then((res) => res.json())
      .then(
        (cargos) => (this.options.cargos = cargos),
        (err) => console.log(err)
      );
  },

  methods: {
    onSubmit() {
      let empresa_id = this.$store.state.usuario.empresa.id;
      this.$http.post(`empresa/${empresa_id}/usuario`, this.usuario).then(
        (res) => {
          res.json();
          this.successNotify();
          this.usuario = new Usuario();
          this.$router.push({ name: "funcionariosempresa" });
        },
        (err) => {
          console.log(err);
          this.errorNotify();
        }
      );
    },

    successNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "positive",
        message: "Funcionário cadastrado com sucesso!",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao cadastrar funcionário! Tente novamente.",
      });
    },
  },
};
</script>

<style scoped>
.card {
  width: 80vw;
  max-width: 100vw;
  border-radius: 20px;
}

.bg-btn-cadastrar {
  background: #2e4a80;
}
</style>
