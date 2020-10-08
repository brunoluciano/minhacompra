<template>
  <div>
    <q-dialog v-model="open" class="q-ma-none">
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
              v-model="email"
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
              v-model="password"
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
              @click="onClick"
              style="width: 100%"
            />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
export default {
  name: "login-cliente",
  props: ["open"],
  watch: {
    open: function () {
      this.$emit("teste", false);
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
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#2e8076",endColorstr="#156749",GradientType=1);
}

.bg-btn-cadastrar {
  background: #2e8076;
}
</style>