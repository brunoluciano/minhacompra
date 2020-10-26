<template>
  <div class="shadow-3 rounded-borders bg-blue-grey-1">
    <splide :slides="banners" :options="options" @splide:moved="moved">
      <splide-slide v-for="banner in banners" :key="banner.id">
        <q-img
          :src="banner.imgUrl"
          width="100%"
          transition="fade"
          class="rounded-borders"
        />
      </splide-slide>
    </splide>
  </div>
</template>

<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/themes/splide-sea-green.min.css";

export default {
  components: {
    Splide,
    SplideSlide,
  },

  props: ["banners"],

  data() {
    return {
      options: {
        rewind: true,
        focus: "center",
        perPage: 1,
        autoplay: true,
        autoHeight: true,
      },
    };
  },
};
</script>

<style scoped>
.splide {
  padding: 0;
}
</style>