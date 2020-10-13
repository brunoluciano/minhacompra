<template>
  <div class="q-pa-lg">
    <div class="row">
      <div class="col text-center">
        <div class="text-h3 q-my-lg text-grey-7">
          Selecione um supermercado próximo a você!
        </div>
      </div>
    </div>

    <div class="shadow-10 bg-blue-grey-3 q-pa-lg" style="border-radius: 20px">
      <div class="row justify-center">
        <div class="col-12 col-md-8 text-center text-white q-pa-md">
          <h4 class="q-my-none">Busca por CEP</h4>
          <q-input
            rounded
            outlined
            dark
            color="blue-5"
            bg-color="blue-grey-10"
            style="opacity: 0.9"
          >
            <template v-slot:append>
              <q-btn
                push
                outline
                flat
                rounded
                icon="search"
                label="Buscar"
                @click="buscarLojas"
              />
            </template>
          </q-input>
        </div>
      </div>
      <br />
      <div class="row q-col-gutter-x-xl q-col-gutter-y-lg">
        <div class="col-12 col-sm-6 col-md-3" v-for="n in 12" :key="n">
          <q-card class="bg-grey-2 shadow-3 lista-card-loja q-pa-xs" bordered>
            <q-item>
              <q-item-section avatar>
                <q-avatar class="shadow-3" size="50px">
                  <img
                    src="https://static-images.ifood.com.br/image/upload//logosgde/2959111d-2628-46c6-9fb5-a42a710ad29a/201912201539_o5xi_i.png"
                  />
                </q-avatar>
              </q-item-section>

              <q-item-section>
                <q-item-label class="ellipsis">
                  <span class="text-h5 text-weight-bold text-grey-7"
                    >Supermercado Supermercado

                    <q-tooltip anchor="top middle" self="center middle">
                      Supermercado Supermercado
                    </q-tooltip>
                  </span>
                </q-item-label>
                <q-item-label caption
                  >Av. Brasil, 123 - Bairro <br />
                  São Paulo - SP</q-item-label
                >
              </q-item-section>
            </q-item>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      n: "",
    };
  },
};
</script>

<style>
.lista-card-loja {
  border: 3px solid transparent;
  transition: ease 0.3s;
  border-radius: 50px;
  cursor: pointer;
}

.lista-card-loja:hover {
  transition: ease 0.3s;
  background-color: #ececec;
  border: 3px solid #9eb5ca;
  -moz-transform: scale(1.08);
  -webkit-transform: scale(1.08);
  transform: scale(1.08);
  overflow: hidden;
}
</style>