<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-gradient-menu text-white">
      <q-toolbar class="row items-center">
        <div class="col">
          <router-link
            :to="{ name: 'dashboardgerente' }"
            class="remove-link-style"
          >
            <q-toolbar-title>
              <h4 class="q-ma-sm">
                <q-icon name="mdi-store" size="auto"></q-icon>
                Minha Empresa
              </h4>
            </q-toolbar-title>
          </router-link>
        </div>
        <div class="col text-right">
          <q-btn-dropdown
            push
            rounded
            no-caps
            color="btn-login"
            @click="abrirModalLogin"
          >
            <template v-slot:label>
              <q-icon left name="person" />
              <div class="text-center q-pa-none">
                Olá
                <span class="text-weight-bold">{{ user.nome }}</span>
              </div>
            </template>
            <q-list class="text-grey-8">
              <q-item clickable v-close-popup @click="onItemClick">
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
        </div>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <slot></slot>
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: "main-menu",
  data() {
    return {
      modal: {
        login: false,
        cadastro: false,
      },

      user: {},
    };
  },

  created() {
    this.user = this.$store.state.usuario.data;
  },

  methods: {
    sair() {
      this.$store.commit("logout");
      // this.$http
      //   .post("auth/usuario/logout", {
      //     headers: {
      //       Authorization: `Bearer ${localStorage.token}`,
      //     },
      //   })
      //   .then(
      //     (res) => {
      //       res.json();
      //       this.$router.push({ name: "home" });
      //       this.$store.state.usuario = "";
      //     },
      //     (err) => {
      //       console.log(err);
      //     }
      //   );
      // this.user = "";
    },
  },
};
</script>

<style scoped>
.bg-btn-login {
  background-color: #1d8d97;
}

.bg-gradient-menu {
  background: rgb(73, 115, 179);
  background: -moz-linear-gradient(
    90deg,
    rgba(73, 115, 179, 1) 0%,
    rgba(45, 77, 167, 1) 100%
  );
  background: -webkit-linear-gradient(
    90deg,
    rgba(73, 115, 179, 1) 0%,
    rgba(45, 77, 167, 1) 100%
  );
  background: linear-gradient(
    90deg,
    rgba(73, 115, 179, 1) 0%,
    rgba(45, 77, 167, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#4973b3",endColorstr="#2d4da7",GradientType=1);
}
</style>
