<template>
  <div>
    <div class="row q-col-gutter-x-lg q-col-gutter-y-xl">
      <div class="col-12 col-md-3">
        <departamentos :idEmpresa="id"></departamentos>
      </div>
      <div class="col-12 col-md-9">
        <slide-banners :banners="banners"></slide-banners>
      </div>
    </div>
    <q-separator class="q-my-lg" />
  </div>
</template>

<script>
import SlideBanners from "./SlideBanners.vue";
import Departamentos from "./Departamentos.vue";

export default {
  components: {
    SlideBanners,
    Departamentos,
  },

  data() {
    return {
      id: "",
      banners: [],
    };
  },

  created() {
    this.id = this.$route.params.id;
    this.$http
      .get(`empresa/${this.id}/images/banner`)
      .then((res) => res.json())
      .then(
        (banners) => {
          this.banners = banners;
          this.banners.forEach((banner) => {
            banner.imgUrl = `${this.$http.options.root}/empresa/${this.id}/images/banner/${banner.id}/img`;
          });
        },
        (err) => console.log(err)
      );
  },
};
</script>

<style scoped>
</style>