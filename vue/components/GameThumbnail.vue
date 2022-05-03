<template>
  <div class="col-md-6">
    <div v-if="isLoaded" class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <img :src="source" class="rounded mx-auto img-thumbnail" alt="ThumbnailImage">
        <form method="GET" :action="playUrl" class="mx-auto mt-3">
          <input type="submit" class="btn btn-primary py-2 px-4" value="Play now!">
        </form>
      </div>
    </div>

    <div v-else>
      <br><br><br><br>
      <LoadingSpinner/>
    </div>
  </div>
</template>

<script>
import LoadingSpinner from './LoadingSpinner.vue';

export default {
  name: 'GameThumbnail',
  components: { LoadingSpinner },
  props: {
    source: {
      type: String,
      required: true
    },
    playUrl: {
      type: String,
      required: true
    },
  },
  computed: {
    isLoaded() {
      return this.source !== '';
    }
  }
}
</script>

<style scoped>

</style>