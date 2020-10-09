<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-gradient-menu text-white">
      <q-toolbar class="row items-center">
        <div class="col">
          <router-link :to="{ name: 'home' }" class="remove-link-style">
            <q-toolbar-title>
              <h4 class="q-ma-sm">
                <q-icon name="mdi-cart-variant" size="auto"></q-icon>
                Minha Compra
              </h4>
            </q-toolbar-title>
          </router-link>
        </div>
        <div class="col text-right">
          <q-btn
            push
            rounded
            no-caps
            class="bg-btn-login"
            icon="person"
            label="Entrar ou Cadastrar"
            @click="modalLogin = true"
          />
        </div>
      </q-toolbar>
    </q-header>

    <!-- MODAL LOGIN -->
    <!-- <login-cliente :open="modalLogin" @teste="closedModal" /> -->
    <q-dialog v-model="modalLogin" class="q-ma-none">
      <q-card
        style="width: 60vw; max-width: 110vw; border-radius: 30px"
        class="shadow-5"
      >
        <q-card-section class="row q-pa-none text-center">
          <q-btn
            class="absolute-top-right q-mt-sm q-mr-sm"
            icon="close"
            flat
            round
            dense
            v-close-popup
          />
          <div
            class="col-12 col-md-7 bg-gradient-login q-pa-xl q-ma-none text-white"
          >
            <span class="text-h4">Acessar Sistema</span>
            <hr class="q-mb-lg" />
            <q-input
              rounded
              filled
              dark
              color="cyan-3"
              type="email"
              v-model="login.email"
              label="E-mail"
            >
              <template v-slot:prepend>
                <q-icon name="person" />
              </template>
            </q-input>

            <br />

            <q-input
              rounded
              filled
              dark
              color="cyan-3"
              type="password"
              v-model="login.password"
              label="Senha"
            >
              <template v-slot:prepend>
                <q-icon name="vpn_key" />
              </template>
            </q-input>

            <br />

            <div class="row text-left q-pa-none">
              <div class="col-12 col-md-6">
                <q-checkbox
                  dark
                  v-model="login.manterConectado"
                  label="Manter-me conectado"
                  color="cyan-4"
                />
              </div>
              <div class="col-12 col-md-6 text-right">
                <q-btn
                  flat
                  rounded
                  color="grey-4"
                  no-caps
                  label="Esqueci minha senha"
                />
              </div>
            </div>

            <br />

            <q-btn
              push
              rounded
              color="cyan-4"
              label="Entrar"
              type="submit"
              @click="onClick"
              style="width: 100%"
            />
          </div>
          <div class="col-12 col-md-5 q-pa-xl q-ma-none">
            <span class="text-h4 text-teal-8">Criar Conta</span>
            <hr class="text-teal-8 q-mb-md" />
            <p class="text-italic text-grey-8">
              Não possui conta? Faça uma agora mesmo!
            </p>
            <q-btn
              push
              rounded
              color="btn-cadastrar"
              label="Cadastrar-se"
              @click="modalCadastro = true"
              style="width: 100%"
            />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>

    <!-- MODAL CADASTRO CLIENTE -->
    <q-dialog v-model="modalCadastro" persistent>
      <q-card
        style="width: 80vw; max-width: 100vw; border-radius: 20px"
        class="q-pa-md"
      >
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
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.telefone"
                  label="Telefone"
                  type="text"
                  color="cyan-7"
                  class="col-12 col-md-4"
                />
                <q-input
                  rounded
                  outlined
                  v-model="cadastro.nascimento"
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

    <q-page-container>
      <slot></slot>
    </q-page-container>

    <!-- <q-footer elevated class="bg-dark text-white">
      <q-toolbar> </q-toolbar>
    </q-footer> -->
  </q-layout>
</template>

<script>
// import CadastrarCliente from "../main/forms/CadastrarCliente.vue";

export default {
  name: "main-menu",
  data() {
    return {
      modalLogin: false,
      modalCadastro: false,

      login: {
        email: "",
        password: "",
        manterConectado: false,
      },

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

  components: {
    // CadastrarCliente,
  },

  methods: {
    closedModal: function (value) {
      this.modalCadastro = value;
    },
  },
};
</script>

<style scoped>
.bg-btn-login {
  background-color: #065a97;
}

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
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#49b3a7", endColorstr="#2da77a", GradientType=1);
}

.bg-gradient-login {
  background: rgb(46, 128, 118);
  background: -moz-linear-gradient(
    90deg,
    rgba(46, 128, 118, 1) 0%,
    rgba(21, 103, 73, 1) 100%
  );
  background: -webkit-linear-gradient(
    90deg,
    rgba(46, 128, 118, 1) 0%,
    rgba(21, 103, 73, 1) 100%
  );
  background: linear-gradient(
    90deg,
    rgba(46, 128, 118, 1) 0%,
    rgba(21, 103, 73, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#2e8076", endColorstr="#156749", GradientType=1);
}

.bg-btn-cadastrar {
  background: #2e8076;
}
</style>
