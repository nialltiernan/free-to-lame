<template>
  <div v-if="isLoaded" id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
    <ol class="carousel-indicators">
      <li v-for="screenshot in screenshots" :key="screenshot.id" data-target="#carouselExampleIndicators"
          :data-slide-to="screenshot.id" :class="{ active: isActive(screenshot.id) }">
      </li>
    </ol>
    <div class="carousel-inner">
      <div v-for="screenshot in screenshots" :key="screenshot.id" class="carousel-item"
           :class="{ active: isActive(screenshot.id) }">
        <img :src="screenshot.image" class="d-block w-100" alt="Screenshot">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div v-else>
    <br><br>
    <LoadingSpinner :radius="64" />
    <br><br>
  </div>
</template>

<script>
import LoadingSpinner from './LoadingSpinner.vue';

export default {
  name: 'GameScreenshots',
  components: { LoadingSpinner },
  props: {
    screenshots: {
      type: Array,
      required: true
    },
    color: {
      type: String,
      required: true
    }
  },
  methods: {
    isActive(screenshotId) {
      return screenshotId === this.screenshots[0].id;
    }
  },
  computed: {
    isLoaded() {
      return this.screenshots.length;
    }
  }
}
</script>

<style scoped>

</style>