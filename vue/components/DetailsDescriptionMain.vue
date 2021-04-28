<template>
  <div class="col-md-6">
    <div class="row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <DetailsDescriptionTitle :title="title" :genre="genre" :platform="platform" :publisher="publisher"
                                 :developer="developer" :releaseDate="releaseDate"/>

        <p>{{ description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import DetailsDescriptionTitle from './DetailsDescriptionTitle.vue';

export default {
  components: {DetailsDescriptionTitle},

  name: 'DetailsDescriptionMain',
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
    },
  }
}
</script>

<style scoped>

</style>