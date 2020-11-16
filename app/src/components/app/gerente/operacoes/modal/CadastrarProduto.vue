<template>
  <div>
    <q-dialog v-model="mostraModal" persistent>
      <q-card class="card q-pa-md">
        <q-card-section>
          <div class="text-h3 text-teal-8">Cadastrar Novo Produto</div>
          <hr />
        </q-card-section>

        <q-card-section class="row q-pt-none">
          <div class="col">
            <q-form @submit.prevent="onSubmit">
              <div class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start">
                <q-file
                  rounded
                  outlined
                  v-model="produto.imgProduto"
                  label="Imagem do Produto"
                  color="blue-grey-6"
                  use-chips
                  type="file"
                  class="col-12 col-md-3"
                  name="imgProduto"
                >
                  <template v-slot:append>
                    <q-icon name="photo" />
                  </template>
                </q-file>
                <q-input
                  rounded
                  outlined
                  v-model="produto.descricao"
                  label="Descricao"
                  type="text"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="produto.departamento_id"
                  :options="options.departamento"
                  option-label="descricao"
                  option-value="id"
                  label="Departamento"
                  emit-value
                  map-options
                  color="blue-grey-6"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="produto.categoria_id"
                  :options="options.categoria"
                  option-label="descricao"
                  option-value="id"
                  label="Categoria"
                  emit-value
                  map-options
                  color="blue-grey-6"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-select
                  rounded
                  outlined
                  v-model="produto.marca_id"
                  :options="options.marca"
                  option-label="descricao"
                  option-value="id"
                  label="Marca"
                  emit-value
                  map-options
                  color="blue-grey-6"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-select
                  rounded
                  outlined
                  v-model="produto.unidade_medida_id"
                  :options="options.unidade_medida"
                  option-label="descricao"
                  option-value="id"
                  label="Unidade de Medida"
                  emit-value
                  map-options
                  color="blue-grey-6"
                  transition-show="jump-down"
                  transition-hide="jump-up"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="produto.unidade"
                  label="Unidade"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="produto.cod_barras"
                  label="Código de Barras"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
              </div>
              <div
                class="q-col-gutter-x-sm q-col-gutter-y-sm row items-start q-mt-sm"
              >
                <q-input
                  rounded
                  outlined
                  v-model="produto.estoque_minimo"
                  label="Estoque Mínimo"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="produto.estoque_atual"
                  label="Estoque Atual"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="produto.estoque_maximo"
                  label="Estoque Máximo"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
                />
                <q-input
                  rounded
                  outlined
                  v-model="produto.preco"
                  label="Preço"
                  type="number"
                  color="blue-grey-6"
                  class="col-12 col-md-3"
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
import Produto from "../../../../../domain/produto/Produto";

export default {
  props: ["mostraModal"],

  data() {
    return {
      empresa_id: "",
      produto: new Produto(),
      form: new FormData(),

      options: {
        departamento: [],
        categoria: [],
        marca: [],
        unidade_medida: [],
      },
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
    this.produto.empresa_id = this.empresa_id;

    this.$http
      .get(`empresa/${this.empresa_id}/departamento`)
      .then((res) => res.json())
      .then(
        (departamentos) => (this.options.departamento = departamentos),
        (err) => console.log(err)
      );
    this.$http
      .get(`empresa/${this.empresa_id}/categoria`)
      .then((res) => res.json())
      .then(
        (categorias) => (this.options.categoria = categorias),
        (err) => console.log(err)
      );
    this.$http
      .get(`empresa/${this.empresa_id}/marca`)
      .then((res) => res.json())
      .then(
        (marcas) => (this.options.marca = marcas),
        (err) => console.log(err)
      );
    this.$http
      .get(`unidademedida`)
      .then((res) => res.json())
      .then(
        (unidadesmedida) => (this.options.unidade_medida = unidadesmedida),
        (err) => console.log(err)
      );
  },

  methods: {
    onSubmit() {
      this.form.append("imgProduto", this.produto.imgProduto);
      this.form.append("descricao", this.produto.descricao);
      this.form.append("departamento_id", this.produto.departamento_id);
      this.form.append("categoria_id", this.produto.categoria_id);
      this.form.append("marca_id", this.produto.marca_id);
      this.form.append("unidade_medida_id", this.produto.unidade_medida_id);
      this.form.append("unidade", this.produto.unidade);
      this.form.append("cod_barras", this.produto.cod_barras);
      this.form.append("estoque_minimo", this.produto.estoque_minimo);
      this.form.append("estoque_atual", this.produto.estoque_atual);
      this.form.append("estoque_maximo", this.produto.estoque_maximo);
      this.form.append("preco", this.produto.preco);
      this.form.append("promocao_ativa", 0);
      this.$http.post(`empresa/${this.empresa_id}/produto`, this.form).then(
        (res) => {
          res.json();
          this.successNotify();
          this.produto = new Produto();
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
        message: "Produto cadastrado com sucesso!",
      });
    },
    errorNotify() {
      this.$q.notify({
        progress: true,
        position: "top",
        type: "negative",
        message: "Erro ao cadastrar produto! Tente novamente.",
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