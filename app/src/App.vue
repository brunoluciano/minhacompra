<template>
<div>
    <main-menu>
        <q-img class="filter-image" :src="image" style="max-height: 50vh" transition="fade" />

        <div class="row q-pa-md">
            <div class="col-12">
                <q-input square outlined v-model="text" label="Nome" placeholder="Insira o seu nome" />

                <q-chip v-if="text" color="teal" text-color="white" icon="person" size="1em">
                    {{ text }}
                </q-chip>
                <q-chip v-if="number" color="orange" text-color="white" icon="fas fa-coins" size="1em">
                    {{ number }}
                </q-chip>
            </div>
            <hr />
            <div class="col-12">
                <q-circular-progress :value="number" size="50px" color="red" class="q-ma-md shadow-lg" />

                <q-slider v-model="number" :min="0" :max="max_number" />

                <q-btn-group push>
                    <q-btn push label="Menos" icon="fas fa-minus" v-on:click="number_minus()" />
                    <q-btn push label="Mais" icon="fas fa-plus" v-on:click="number_plus()" />
                </q-btn-group>
            </div>
        </div>

        <br /><br />
    </main-menu>
</div>
</template>

<script>
// import LayoutComponent from "./components/MainLayout.vue";
import MainMenu from "./components/layout/MainMenu.vue";
import Image from "./assets/bg_main.jpg";

export default {
    name: "LayoutDefault",

    components: {
        // LayoutComponent,
        MainMenu,
    },

    data() {
        return {
            leftDrawerOpen: false,
            image: Image,
            text: "",
            number: 0,
            max_number: 100,
        };
    },

    methods: {
        number_plus() {
            if (this.number >= 0 && this.number < this.max_number) {
                this.number++;
            }
        },
        number_minus() {
            if (this.number > 0) {
                this.number--;
            } else {
                this.number = 0;
            }
        },
    },
};
</script>

<style scoped>
.filter-image {
    background-color: black;
}
</style>
