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
                <q-input rounded outlined dark v-model="buscaCep.cep" debounce="500" mask="#####-###" unmasked-value color="blue-5" bg-color="blue-grey-10" style="opacity: 0.9" v-on:input="buscarLojas">
                    <template v-slot:append>
                        <q-btn push outline flat rounded icon="search" label="Buscar" @click="buscarLojas" />
                    </template>
                </q-input>
            </div>
        </div>
        <br />
        <div class="row q-col-gutter-x-xl q-col-gutter-y-lg">
            <div class="col-12 col-sm-6 col-md-4" v-for="loja in lojas" :key="loja">
                <router-link :to="{ name: 'loja', params: { id: loja.id }}" class="remove-link-style">
                    <q-card class="bg-grey-2 shadow-3 lista-card-loja q-pa-xs" bordered>
                        <q-item>
                            <q-item-section avatar>
                                <q-avatar class="shadow-3" size="60px">
                                    <q-img :src="loja.imgUrl" transition="fade" spinner-color="grey" />
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label class="ellipsis">
                                    <span class="text-h5 text-weight-bold text-grey-7">{{ loja.nome }}

                                        <q-tooltip anchor="top middle" self="center middle">
                                            {{ loja.nome }}
                                        </q-tooltip>
                                    </span>
                                </q-item-label>
                                <q-item-label caption>{{ loja.endereco }}, {{ loja.numero }} - {{ loja.bairro }}
                                    <br />
                                    {{ loja.estado.descricao }} -
                                    {{ loja.estado.sigla }}
                                </q-item-label>
                            </q-item-section>
                        </q-item>
                    </q-card>
                </router-link>
            </div>
        </div>

        <div class="row q-my-lg" v-if="!lojasEncontradas">
            <div class="col-12 text-center">
                <q-card class="bg-yellow-2 shadow-3 q-pa-md lista-card-loja" bordered>
                    <div class="text-h5 text-grey-8" v-if="!buscaCep.loadingState">
                        Nenhum loja encontrada!
                    </div>
                    <div class="text-h5 text-grey-8" v-else>
                        <q-spinner size="2em" />
                    </div>
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
            buscaCep: {
                cep: "",
                loadingState: false,
            },
            lojas: [],
            lojasEncontradas: false,
        };
    },

    mounted() {
        this.buscaCep.cep = this.$route.params.cep;
        this.buscarLojas();
    },

    methods: {
        buscarLojas() {
            this.buscaCep.loadingState = true;
            this.$http
                .post("empresa/cep", this.buscaCep)
                .then((res) => res.json())
                .then(
                    (lojas) => {
                        this.buscaCep.loadingState = false;
                        this.lojasEncontradas = lojas != "" ? true : false;

                        this.lojas = lojas;
                        console.log(this.lojas);

                        // buscando respectiva imagem da empresa e atribuindo a um atributo
                        this.lojas.forEach((loja) => {
                            let url = `${this.$http.options.root}/empresa/${loja.id}/images/logo`;
                            loja.imgUrl = url;
                        });
                    },
                    (err) => {
                        console.log(err);
                        this.lojasEncontradas = false;
                    }
                );
        },
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
