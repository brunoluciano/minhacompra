<template>
  <div>
    <q-dialog v-model="mostraModal" persistent>
      <q-card class="card q-pa-md">
        <q-card-section>
          <div class="text-h3 text-teal-8">Criar Conta</div>
          <hr />
        </q-card-section>

        <q-card-section class="row q-pt-none">
          <div class="col">
            <q-form @submit.prevent="onSubmit">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.nome"
                  label="Nome"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cliente.email"
                  label="E-mail"
                  type="email"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cliente.password"
                  label="Senha"
                  type="password"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cliente.cnf_password"
                  label="Confirmar senha"
                  type="password"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.cpf"
                  label="CPF"
                  type="text"
                  color="cyan-7"
                  mask="###.###.###-##"
                  unmasked-value
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="pessoa.sexo"
                  :options="options.sexo"
                  option-label="descricao"
                  option-value="id"
                  label="Sexo"
                  emit-value
                  map-options
                  color="cyan-7"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.endereco"
                  label="Endereço"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model.number="pessoa.numero"
                  label="Número"
                  type="number"
                  color="cyan-7"
                  class="col-12 col-md-2"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.bairro"
                  label="Bairro"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.complemento"
                  label="Complemento"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.cidade"
                  label="Cidade"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="pessoa.estado_id"
                  :options="options.estado"
                  option-label="descricao"
                  option-value="id"
                  label="Estado"
                  emit-value
                  map-options
                  color="cyan-7"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.cep"
                  label="CEP"
                  type="text"
                  color="cyan-7"
                  mask="#####-###"
                  unmasked-value
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.telefone"
                  label="Telefone"
                  type="text"
                  color="cyan-7"
                  mask="(##) #####-####"
                  unmasked-value
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="pessoa.nascimento"
                  label="Data de nascimento"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-4"
                >
                  <template v-slot:append>
                    <q-icon name="event" class="cursor-pointer">
                      <q-popup-proxy
                        ref="qDateProxy"
                        transition-show="jump-down"
                        transition-hide="jump-up"
                      >
                        <q-date
                          v-model="pessoa.nascimento"
                          color="cyan-7"
                          mask="YYYY-MM-DD"
                        >
                          <div class="row items-center justify-end">
                            <q-btn
                              v-close-popup
                              label="Fechar"
                              color="cyan-8"
                              flat
                            />
                          </div>
                        </q-date>
                      </q-popup-proxy>
                    </q-icon>
                  </template>
                </q-input>
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
import Pessoa from "../../../domain/cliente/Pessoa";
import Cliente from "../../../domain/cliente/Cliente";

export default {
  props: ["mostraModal"],

  data() {
    return {
      pessoa: new Pessoa(),
      cliente: new Cliente(),

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
      this.$http
        .post("pessoa", this.pessoa)
        .then((res) => res.json())
        .then(
          (pessoaInserida) => {
            this.pessoa.id = pessoaInserida.id;
            this.cliente.pessoa_id = pessoaInserida.id;

            this.$http.post("cliente", this.cliente).then(
              (res) => {
                res.json();
                this.successNotify();
                this.pessoa = new Pessoa();
                this.cliente = new Cliente();
              },
              (err) => {
                console.log(err);
                this.errorNotify();
              }
            );
          },
          (err) => console.log(err)
        );
    },

    successNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "positive",
        message: "Conta criada com sucesso! Faça o seu login agora mesmo.",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao criar conta! Tente novamente.",
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
</style>
