<template>
  <div>
    <q-drawer
      v-model="drawer"
      show-if-above
      :mini="!drawer || miniState"
      @click.capture="drawerClick"
      :width="300"
      :breakpoint="800"
      content-class="bg-blue-grey-1 shadow-5"
    >
      <template v-slot:mini>
        <q-scroll-area class="fit mini-slot cursor-pointer">
          <div class="q-py-lg">
            <div class="column items-center">
              <q-avatar class="col">
                <img
                  src="https://static-images.ifood.com.br/image/upload//logosgde/2959111d-2628-46c6-9fb5-a42a710ad29a/201912201539_o5xi_i.png"
                />
              </q-avatar>
              <q-separator color="grey" class="q-my-lg" />
              <q-icon
                name="person"
                color="blue-grey-8"
                size="2rem"
                class="col"
              />
            </div>
          </div>
        </q-scroll-area>
      </template>

      <q-scroll-area class="fit">
        <q-list padding class="q-pa-none text-grey-8">
          <q-item active clickable>
            <q-item-section class="text-center text-blue-grey">
              <q-img
                src="https://static-images.ifood.com.br/image/upload//logosgde/2959111d-2628-46c6-9fb5-a42a710ad29a/201912201539_o5xi_i.png"
                spinner-color="blue-grey-8"
                spinner-size="82px"
                transition="jump-up"
              />
              <div class="text-h5 text-weight-bold text-uppercase">
                Supermercado
              </div>
              <div class="text-subtitle">
                Av. Brasil, 123 - Centro, São Paulo - SP
              </div>
            </q-item-section>
          </q-item>

          <q-separator class="q-my-md" />

          <q-item-section>
            <q-item clickable v-ripple class="text-center">
              <q-item-section class="ellipsis-2-line">
                <div class="text-h5 text-weight-bold">Usuário</div>
              </q-item-section>
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section
                ><div>
                  Editar Perfil
                  <q-icon name="fas fa-user-edit q-ml-xs" size="15px" />
                </div>
              </q-item-section>
            </q-item>
            <q-item clickable v-ripple @click="sair">
              <q-item-section>
                <q-item-label
                  ><div>
                    Sair
                    <q-icon name="fas fa-sign-out-alt q-ml-xs" size="15px" />
                  </div>
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-item-section>
        </q-list>
      </q-scroll-area>

      <!--
          in this case, we use a button (can be anything)
          so that user can switch back
          to mini-mode
        -->
      <div class="q-mini-drawer-hide absolute" style="top: 15px; right: -17px">
        <q-btn
          dense
          round
          unelevated
          color="teal-5"
          icon="chevron_left"
          @click="miniState = true"
        />
      </div>
    </q-drawer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      miniState: false,
    };
  },

  methods: {
    drawerClick(e) {
      // if in "mini" state and user
      // click on drawer, we switch it to "normal" mode
      if (this.miniState) {
        this.miniState = false;

        // notice we have registered an event with capture flag;
        // we need to stop further propagation as this click is
        // intended for switching drawer to "normal" mode only
        e.stopPropagation();
      }
    },

    sair() {
      this.$router.push({ name: "home" });
    },
  },
};
</script>

<style scoped>
</style>