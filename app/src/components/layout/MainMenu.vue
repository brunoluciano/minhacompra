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
            v-if="!clienteLogado"
            push
            rounded
            no-caps
            class="bg-btn-login"
            icon="person"
            label="Entrar ou Cadastrar"
            @click="abrirModalLogin"
          />
          <div v-else>
            <q-btn-dropdown push rounded no-caps color="btn-login">
              <template v-slot:label>
                <q-icon left name="person" />
                <div class="text-center q-pa-none">
                  Olá {{ cliente.pessoa.nome }}
                </div>
              </template>
              <q-list class="text-grey-8" @click="perfil">
                <q-item clickable v-close-popup>
                  <q-item-section>
                    <q-item-label>
                      <q-icon name="edit" /> Editar Perfil
                    </q-item-label>
                  </q-item-section>
                </q-item>
                <q-item clickable v-close-popup @click="sair">
                  <q-item-section>
                    <q-item-label> <q-icon name="logout" /> Sair </q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
            <q-btn
              dense
              round
              flat
              icon="mdi-cart-outline"
              class="q-mx-md"
              size="1em"
              @click="abrirModalCarrinho"
            >
              <q-badge rounded color="orange-8" floating>{{
                carrinho.qtdItens
              }}</q-badge>
            </q-btn>
          </div>
        </div>
      </q-toolbar>
    </q-header>

    <!-- MODAL LOGIN -->
    <login-cliente :mostraModal="modal.login" @fecharModal="fecharModalLogin" />

    <!-- MODAL CARRINHO -->
    <modal-carrinho
      :mostraModal="modal.carrinho"
      @fecharModal="fecharModalCarrinho"
    />

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
import ModalCarrinho from "../main/cliente/ModalCarrinho.vue";

export default {
  name: "main-menu",
  data() {
    return {
      modal: {
        login: false,
        cadastro: false,
        carrinho: false,
      },

      carrinho: {
        qtdItens: 0,
      },

      clienteLogado: false,
      cliente: {},
    };
  },

  components: {
    LoginCliente,
    ModalCarrinho,
  },

  created() {
    this.$store.commit("loginCliente");
    this.carrinho.qtdItens = this.$root.qtdItensCarrinho;
    this.clienteLogado = this.$store.state.clienteLogado;
    this.cliente = this.$store.state.cliente;
  },

  watch: {
    "$root.qtdItensCarrinho": function (value) {
      this.carrinho.qtdItens = value;
    },
  },

  methods: {
    abrirModalLogin() {
      this.modal.login = true;
    },
    fecharModalLogin(val) {
      this.modal.login = val.target;
    },
    abrirModalCarrinho() {
      this.modal.carrinho = true;
    },
    fecharModalCarrinho(val) {
      this.modal.carrinho = val.target;
    },

    perfil() {
      this.$router.push({ name: "perfil" });
    },
    sair() {
      this.$store.commit("logoutCliente");
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
