<template>
  <div>
    <q-dialog v-model="mostraModal" class="q-ma-none">
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
            <q-separator class="q-mb-lg bg-white" />

            <q-form @submit.prevent="onSubmit">
              <q-input
                rounded
                filled
                dark
                color="blue-3"
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
                color="blue-3"
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
                    v-model="manterConectado"
                    label="Manter-me conectado"
                    color="blue-11"
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
                color="blue-11"
                label="Entrar"
                type="submit"
                style="width: 100%"
              />
            </q-form>
          </div>
          <div class="col-12 col-md-5 q-py-xl q-px-lg q-ma-none">
            <span class="text-h4 text-cadastrar">Cadastrar Empresa</span>
            <q-separator class="bg-teal-8 q-mb-md" />
            <p class="text-italic text-grey-8">
              Não possui sua loja cadastrada? Registre agora mesmo!
            </p>
            <q-btn
              push
              rounded
              color="btn-cadastrar"
              label="Cadastrar-se"
              @click="abrirModalCadastro"
              style="width: 100%"
            />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>

    <!-- MODAL CADASTRO -->
    <modal-cadastro-empresa
      :mostraModal="modal.cadastro"
      @fecharModal="fecharModalCadastro"
    />
  </div>
</template>

<script>
import ModalCadastroEmpresa from "./ModalCadastroEmpresa.vue";

export default {
  props: ["mostraModal"],

  components: {
    ModalCadastroEmpresa,
  },

  data() {
    return {
      login: {
        email: "",
        password: "",
      },
      manterConectado: false,

      modal: {
        cadastro: false,
      },
    };
  },

  methods: {
    abrirModalCadastro() {
      this.modal.cadastro = true;
    },
    fecharModalCadastro(val) {
      this.modal.cadastro = val.target;
    },

    onSubmit() {
      // Auth

      // console.log(this.$auth.login());

      this.$http
        .post("auth/usuario/login", this.login)
        .then((res) => res.json())
        .then((token) => {
          localStorage.token = token.access_token;
          localStorage.user = token.user;

          // this.$http.post(`empresa/${idEmpresa}/usuario`, this.usuario).then(
          //   (res) => {
          //     res.json();
          //     this.successNotify();
          //     this.usuario = new Usuario();
          //   },
          //   (err) => {
          //     console.log(err);
          //     this.errorNotify();
          //   }
          // );

          this.$router.push({
            name: "dashboardgerente",
          });
          this.successNotify();
        }),
        (err) => {
          console.log(err);
          this.errorNotify();
        };
    },

    successNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "positive",
        message: "Login realizado com sucesso!",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao realizar o login!",
      });
    },
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
.bg-gradient-login {
  background: rgb(46, 74, 128);
  background: -moz-linear-gradient(
    90deg,
    rgba(46, 74, 128, 1) 0%,
    rgba(21, 47, 103, 1) 100%
  );
  background: -webkit-linear-gradient(
    90deg,
    rgba(46, 74, 128, 1) 0%,
    rgba(21, 47, 103, 1) 100%
  );
  background: linear-gradient(
    90deg,
    rgba(46, 74, 128, 1) 0%,
    rgba(21, 47, 103, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#2e4a80", endColorstr="#152f67", GradientType=1);
}

.bg-btn-cadastrar {
  background: #2e4a80;
}

.text-cadastrar {
  color: #2e4a80;
}
</style>
