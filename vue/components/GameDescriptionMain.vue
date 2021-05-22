<template>
  <div class="col-md-6">
    <div v-if="isLoaded" class="row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <GameDescriptionTitle :title="title" :genre="genre" :platform="platform" :publisher="publisher"
                                 :developer="developer" :releaseDate="releaseDate"/>

        <p>
          {{ showDescription }}
          <button v-if="!showFullDescription" @click="showMore" class="btn btn-info">Show more</button>
          <button v-else @click="showLess" class="btn btn-info">Show less</button>
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
    }
  },
  computed: {
    isLoaded() {
      return this.title !== '';
    },
    showDescription() {
      return this.showFullDescription ? this.description : this.showDescriptionStart;
    },
    showDescriptionStart() {
      return this.description.substr(0, 450) + '...';
    }
  },
  methods: {
    showMore() {
      this.showFullDescription = true;
    },
    showLess() {
      this.showFullDescription = false;
    }
  }
}
</script>

<style scoped>

</style>