<template>
  <div v-if="isLoaded" class="mt-5">
    <ImageCarousel carousel-id="screenshotCarousel" :images="screenshots"/>

    <div class="modal fade" id="screenshotModal" tabindex="-1" aria-labelledby="screenshotModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <ImageCarousel carousel-id="modalCarousel" :images="screenshots"/>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <br><br>
    <LoadingSpinner :radius="64"/>
    <br><br>
  </div>
</template>

<script>
import LoadingSpinner from './LoadingSpinner.vue';
import ImageCarousel from './ImageCarousel.vue';

export default {
  name: 'GameScreenshots',
  components: { LoadingSpinner, ImageCarousel },
  props: {
    screenshots: {
      type: Array,
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