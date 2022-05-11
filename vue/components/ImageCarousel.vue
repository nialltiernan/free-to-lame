<template>
  <div :id="carouselId" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li v-for="image in images" :key="image.id" :data-target="carouselSelector"
          :data-slide-to="image.id" :class="{ active: isActive(image.id) }">
      </li>
    </ol>
    <div class="carousel-inner">
      <div v-for="screenshot in images" :key="screenshot.id" class="carousel-item"
           :class="{ active: isActive(screenshot.id) }">
        <img :src="screenshot.image" class="d-block w-100" alt="Screenshot">
      </div>
    </div>
    <a class="carousel-control-prev" :href="carouselSelector" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" :href="carouselSelector" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</template>

<script>

export default {
  name: 'ImageCarousel',
  props: {
    carouselId : {
      type: String,
      required: true
    },
    images: {
      type: Array,
      required: true
    }
  },
  methods: {
    isActive(imageId) {
      return imageId === this.images[0].id;
    },
    addEventListeners() {
      document.addEventListener('keydown', (event) => {
        if (event.code ===  'ArrowLeft') {
          $(this.carouselSelector).carousel('prev')
        } else if (event.code ===  'ArrowRight') {
          $(this.carouselSelector).carousel('next')
        }
      });
    }
  },
  computed: {
    carouselSelector() {
      return '#' + this.carouselId;
    }
  },
  created() {
    this.addEventListeners();
  }
}

</script>

<style scoped>

</style>