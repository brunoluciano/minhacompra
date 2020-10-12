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
            @click="abrirModalLogin"
          />
        </div>
      </q-toolbar>
    </q-header>

    <!-- MODAL LOGIN -->
    <login-cliente :mostraModal="modal.login" @fecharModal="fecharModalLogin" />

    <q-page-container>
      <slot></slot>
    </q-page-container>

    <!-- <q-footer elevated class="bg-dark text-white">
      <q-toolbar> </q-toolbar>
    </q-footer> -->
  </q-layout>
</template>

<script>
import LoginCliente from "../main/forms/LoginCliente.vue";

export default {
  name: "main-menu",
  data() {
    return {
      modal: {
        login: false,
        cadastro: false,
      },
    };
  },

  components: {
    LoginCliente,
  },

  methods: {
    abrirModalLogin() {
      this.modal.login = true;
    },
    fecharModalLogin(val) {
      this.modal.login = val.target;
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
</style>
