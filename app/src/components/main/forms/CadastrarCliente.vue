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
            <q-form @submit="onSubmit" @reset="onReset">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.nome"
                  label="Nome"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.email"
                  label="E-mail"
                  type="email"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.password"
                  label="Senha"
                  type="password"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.cnf_password"
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
                  v-model="cadastro.cpf"
                  label="CPF"
                  type="text"
                  color="cyan-7"
                  mask="###.###.###-##"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="cadastro.sexo"
                  :options="options.sexo"
                  label="Sexo"
                  color="cyan-7"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.endereco"
                  label="Endereço"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model.number="cadastro.numero"
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
                  v-model="cadastro.bairro"
                  label="Bairro"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.complemento"
                  label="Complemento"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.cidade"
                  label="Cidade"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="cadastro.uf"
                  :options="options.uf"
                  label="Estado"
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
                  v-model="cadastro.cep"
                  label="CEP"
                  type="text"
                  color="cyan-7"
                  mask="#####-###"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.telefone"
                  label="Telefone"
                  type="text"
                  color="cyan-7"
                  mask="(##) #####-####"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.nascimento"
                  label="Data de nascimento"
                  type="text"
                  color="cyan-7"
                  mask="####/##/##"
                  class="col-12 col-md-4"
                >
                  <template v-slot:append>
                    <q-icon name="event" class="cursor-pointer">
                      <q-popup-proxy
                        ref="qDateProxy"
                        transition-show="jump-down"
                        transition-hide="jump-up"
                      >
                        <q-date v-model="cadastro.nascimento" color="cyan-7">
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
export default {
  props: ["mostraModal"],

  data() {
    return {
      cadastro: {
        nome: "",
        email: "",
        password: "",
        cnf_password: "",
        cpf: "",
        sexo: "",
        endereco: "",
        numero: "",
        bairro: "",
        complemento: "",
        estado: "",
        cep: "",
        telefone: "",
        nascimento: "",
      },

      options: {
        sexo: ["Masculino", "Feminino"],
        uf: ["Espírito Santo", "Minas Gerais", "Rio de Janeiro", "São Paulo"],
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
};
</script>

<style scoped>
.card {
  width: 80vw;
  max-width: 100vw;
  border-radius: 20px;
}
</style>
