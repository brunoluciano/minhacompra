<template>
<div>
    <q-dialog v-model="openmodal">
        <q-card>
            <q-card-section>
                <div class="text-h6">Inception</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis
                laudantium minus earum totam modi laborum illo, corporis fuga saepe
                animi aliquam ea enim assumenda ut nulla natus aperiam quis. Iste.
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn flat label="Open another dialog" @click="secondDialog = true" />
                <q-btn flat label="Close" v-close-popup="closeModal" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</div>
</template>

<script>
export default {
    props: ["openmodal"],
    methods: {
        closeModal() {
            this.$emit("fechoumodal", this.openmodal);
        },
    },
};
</script>

<style scoped>
</style>
