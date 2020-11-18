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
                style="width: 100%"
              />
            </q-form>
          </div>
          <div class="col-12 col-md-5 q-pa-xl q-ma-none">
            <span class="text-h4 text-cadastrar">Criar Conta</span>
            <q-separator class="bg-teal-8 q-mb-md" />
            <p class="text-italic text-grey-8">
              Não possui conta? Faça uma agora mesmo!
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
    <cadastrar-cliente
      :mostraModal="modal.cadastro"
      @fecharModal="fecharModalCadastro"
    />
  </div>
</template>

<script>
import CadastrarCliente from "./CadastrarCliente.vue";

export default {
  props: ["mostraModal"],

  components: {
    CadastrarCliente,
  },

  data() {
    return {
      login: {
        email: "",
        password: "",
        manterConectado: false,
      },

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
      this.$http
        .post("auth/cliente/login", this.login)
        .then((res) => res.json())
        .then((token) => {
          localStorage.setItem("token", token.access_token);
          localStorage.setItem("cliente", JSON.stringify(token.user));

          this.$store.commit("setClienteLogado", true);

          this.$router.push({
            name: "perfil",
          });

          this.successNotify();
        }),
        (err) => {
          console.log(err);
          this.errorNotify();
        };
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

.text-cadastrar {
  color: #2e8076;
}
</style>
