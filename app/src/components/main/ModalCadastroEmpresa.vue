<template>
  <div>
    <q-dialog v-model="mostraModal" persistent>
      <q-card class="card q-pa-md">
        <q-card-section>
          <div class="text-h3 text-cadastrar">Cadastrar Empresa</div>
          <q-separator />
        </q-card-section>

        <q-card-section class="row q-pt-none">
          <div class="col">
            <q-form @submit.prevent="onSubmit">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-input
                  rounded
                  outlined
                  v-model="empresa.nome"
                  label="Nome da empresa"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="empresa.cnpj"
                  label="CNPJ"
                  type="text"
                  mask="##.###.###/####-##"
                  unmasked-value
                  color="indigo-4"
                  class="col-12 col-md-4"
                />
                <q-file
                  rounded
                  outlined
                  v-model="empresa.imgLogo"
                  label="Imagem da empresa"
                  color="indigo-4"
                  use-chips
                  type="file"
                  class="col-12 col-md-4"
                  name="imgLogo"
                >
                  <template v-slot:append>
                    <q-icon name="photo" />
                  </template>
                </q-file>
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="empresa.telefone"
                  label="Telefone"
                  type="text"
                  color="indigo-4"
                  mask="(##) #####-####"
                  unmasked-value
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="empresa.endereco"
                  label="Endereço"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model.number="empresa.numero"
                  label="Número"
                  type="number"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="empresa.complemento"
                  label="Complemento"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="empresa.bairro"
                  label="Bairro"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="empresa.cidade"
                  label="Cidade"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="empresa.estado_id"
                  :options="options.estado"
                  option-label="descricao"
                  option-value="id"
                  label="Estado"
                  emit-value
                  map-options
                  color="indigo-4"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="empresa.cep"
                  label="CEP"
                  type="text"
                  color="indigo-4"
                  mask="#####-###"
                  unmasked-value
                  class="col-12 col-md-3"
                />
              </div>
              <br />
              <div class="text-h5 text-cadastrar">Conta para Acesso</div>
              <q-separator />
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="usuario.nome"
                  label="Nome"
                  type="text"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="usuario.email"
                  label="E-mail"
                  type="email"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model.number="usuario.password"
                  label="Senha"
                  type="password"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="usuario.cnfPassword"
                  label="Confirmar Senha"
                  type="password"
                  color="indigo-4"
                  class="col-12 col-md-3"
                />
              </div>

              <br />
              <div class="q-mt-sm">
                <q-btn-group rounded spread>
                  <q-btn
                    rounded
                    label="Confirmar"
                    type="submit"
                    color="btn-cadastrar"
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
import Empresa from "../../domain/empresa/Empresa";
import Usuario from "../../domain/usuario/Usuario";

export default {
  props: ["mostraModal"],

  data() {
    return {
      empresa: new Empresa(),
      usuario: new Usuario(),
      form: new FormData(),

      options: {
        sexo: [
          {
            id: "M",
            descricao: "Masculino",
          },
          {
            id: "F",
            descricao: "Femino",
          },
        ],
        estado: [],
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
      .get("estado")
      .then((res) => res.json())
      .then(
        (estados) => (this.options.estado = estados),
        (err) => console.log(err)
      );
  },

  methods: {
    onSubmit() {
      this.form.append("nome", this.empresa.nome);
      this.form.append("cnpj", this.empresa.cnpj);
      this.form.append("imgLogo", this.empresa.imgLogo);
      this.form.append("telefone", this.empresa.telefone);
      this.form.append("endereco", this.empresa.endereco);
      this.form.append("numero", this.empresa.numero);
      this.form.append("complemento", this.empresa.complemento);
      this.form.append("cidade", this.empresa.cidade);
      this.form.append("estado_id", this.empresa.estado_id);
      this.form.append("bairro", this.empresa.bairro);
      this.form.append("cep", this.empresa.cep);
      this.$http
        .post("empresa", this.form)
        .then((res) => res.json())
        .then(
          (empresaInserida) => {
            const idEmpresa = empresaInserida.id;
            this.usuario.tipo_usuario_id = 1; // Cadastrar usuário como gerente

            this.$http.post(`empresa/${idEmpresa}/usuario`, this.usuario).then(
              (res) => {
                res.json();
                this.successNotify();
                this.usuario = new Usuario();
              },
              (err) => {
                console.log(err);
                this.errorNotify();
              }
            );

            this.empresa = new Empresa();
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
        message: "Empresa criada com sucesso! Faça o seu login agora mesmo.",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao cadastrar empresa! Tente novamente.",
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

.text-cadastrar {
  color: #2e4a80;
}
</style>
