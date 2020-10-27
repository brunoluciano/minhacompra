<template>
<div>
    <q-dialog v-model="mostraModal">
        <q-card class="card q-pa-lg">
            <q-card-section class="row q-pa-none q-mb-md">
                <q-btn class="absolute-top-right" icon="close" flat round dense v-close-popup />
                <div class="text-h4 text-grey-8">
                    Meu Carrinho de Compra
                    <q-icon name="shopping_cart" />
                </div>
            </q-card-section>

            <q-card-section class="row q-pa-md bg-blue-grey-4">
                <div class="text-h5 text-white text-weight-bold text-uppercase">
                    Produtos
                </div>
                <q-separator color="white" class="q-mb-md" />
                <div class="col-12">
                    <q-markup-table>
                        <thead class="text-center">
                            <tr class="text-white bg-teal">
                                <th class="bold">Produto</th>
                                <th class="bold">Preço</th>
                                <th class="bold">Quantidade</th>
                                <th class="bold">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="n in 5" :key="n">
                                <td class="text-center">
                                    <q-item>
                                        <q-item-section class="text-right">
                                            <q-item-label>
                                                <q-btn dense round color="red-5" padding="xs">
                                                    <q-icon name="close" size="1em" />
                                                </q-btn>
                                            </q-item-label>
                                        </q-item-section>
                                        <q-item-section avatar>
                                            <q-avatar class="shadow-4">
                                                <img src="https://www.kindpng.com/picc/m/411-4119926_cardboard-box-png-clip-art-image-transparent-png.png">
                                            </q-avatar>
                                        </q-item-section>
                                        <q-item-section>
                                            Produto Produto Produto Produto
                                        </q-item-section>
                                    </q-item>

                                </td>
                                <td>24</td>
                                <td>4</td>
                                <td>87</td>
                            </tr>
                        </tbody>
                    </q-markup-table>
                </div>
            </q-card-section>
        </q-card>
    </q-dialog>
</div>
</template>

<script>
export default {
    props: ["mostraModal"],

    data() {
        return {};
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
.card {
    width: 80vw;
    max-width: 100vw;
    border-radius: 20px;
}

.bold {
    font-weight: bold !important;
    font-size: 1em;
}
</style>
