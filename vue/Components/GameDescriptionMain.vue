<template>
  <div class="col-md-6">
    <div v-if="isLoaded" class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <GameDescriptionTitle :title="title" :genre="genre" :platform="platform" :publisher="publisher"
                                 :developer="developer" :releaseDate="releaseDate"/>

        <p>
          {{ showDescription }}
          <img v-if="!showFullDescription" @click="showMore" :src="eyeImage" alt="show more" style="height: 1.5rem" />
          <img v-else @click="showLess" :src="eyeImage" alt="show less" style="height: 1.5rem" />
        </p>
      </div>
    </div>

    <div v-else>
      <br><br><br><br>
      <LoadingSpinner/>
    </div>
  </div>
</template>

<script>
import GameDescriptionTitle from './GameDescriptionTitle.vue';
import LoadingSpinner from './LoadingSpinner.vue';

export default {
  name: 'GameDescriptionMain',
  components: {
    GameDescriptionTitle,
    LoadingSpinner
  },
  props: {
    title: {
      type: String,
      required: true
    },
    genre: {
      type: String,
      required: true
    },
    platform: {
      type: String,
      required: true
    },
    publisher: {
      type: String,
      required: true
    },
    developer: {
      type: String,
      required: true
    },
    releaseDate: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      showFullDescription: false,
      eyeImage: this.getImageEyeEnabled()
    }
  },
  computed: {
    isLoaded() {
      return this.title !== '';
    },
    showDescription() {
      return this.showFullDescription ? this.description : this.shortDescription;
    },
    shortDescription() {
      return this.description.substr(0, 450).trim() + '...';
    }
  },
  methods: {
    getImageEyeEnabled() {
      return BASE_URL + '/img/eye-enabled.png';
    },
    getImageEyeDisabled() {
      return BASE_URL + '/img/eye-disabled.png';
    },
    showMore() {
      this.showFullDescription = true;
      this.eyeImage = this.getImageEyeDisabled();
    },
    showLess() {
      this.showFullDescription = false;
      this.eyeImage = this.getImageEyeEnabled();
    }
  }
}
</script>

<style scoped>

</style>