<template>
  <div>
    <q-dialog v-model="mostraModal" persistent>
      <q-card class="card q-pa-md">
        <q-card-section>
          <div class="text-h3 text-teal-8">Cadastrar Novo Banner</div>
          <hr />
        </q-card-section>

        <q-card-section class="row q-pt-none">
          <div class="col">
            <q-form @submit.prevent="onSubmit">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-file
                  rounded
                  outlined
                  v-model="banner.imgBanner"
                  label="Imagem do Banner"
                  color="blue-grey-6"
                  use-chips
                  type="file"
                  class="col-12 col-md-6"
                  name="imgProduto"
                >
                  <template v-slot:append>
                    <q-icon name="photo" />
                  </template>
                </q-file>
                <q-input
                  rounded
                  outlined
                  v-model="banner.descricao"
                  label="Descricao"
                  type="text"
                  color="blue-grey-6"
                  class="col-12 col-md-6"
                />
              </div>
              <br />
              <div class="q-mt-sm">
                <q-btn-group rounded spread>
                  <q-btn
                    rounded
                    label="Confirmar"
                    type="submit"
                    color="secondary"
                    v-close-popup
                  />
                  <q-btn
                    outline
                    rounded
                    label="Cancelar"
                    type="reset"
                    color="grey"
                    v-close-popup
                  />
                </q-btn-group>
              </div>
            </q-form>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
// import Produto from "../../../../../domain/produto/Produto";

export default {
  props: ["mostraModal"],

  data() {
    return {
      empresa_id: "",
      banner: {
        imgBanner: "",
        descricao: "",
        ativo: 1,
      },
      form: new FormData(),
    };
  },

  watch: {
    mostraModal: function () {
      if (!this.mostraModal) {
        this.$emit("fecharModal", this.mostraModal);
      }
    },
  },

  created() {
    this.empresa_id = this.$store.state.usuario.empresa.id;
    // this.produto.empresa_id = this.empresa_id;
  },

  methods: {
    onSubmit() {
      let empresa_id = this.$store.state.usuario.empresa.id;
      this.form.append("imgBanner", this.banner.imgBanner);
      this.form.append("descricao", this.banner.descricao);
      this.form.append("ativo", 1);
      this.$http
        .post(`empresa/${empresa_id}/images/banner`, this.form)
        .then((res) => res.json())
        .then(
          (banner) => {
            this.banner.imgBanner = "";
            this.banner.descricao = "";
            let bannerAdicionado = banner;
            this.$emit("bannerAdicionado", bannerAdicionado);
            this.successNotify();
          },
          (err) => {
            console.log(err);
            this.errorNotify();
          }
        );
    },

    successNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "positive",
        message: "Banner cadastrado com sucesso!",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao cadastrar banner! Tente novamente.",
      });
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
</style>