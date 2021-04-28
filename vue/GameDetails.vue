<template>
  <div class="row">
    <DetailsThumbnail :thumbnail-source="thumbnailSource" :play-url="playUrl"/>
    <DetailsDescriptionMain :title="title" :genre="genre" :platform="platform" :publisher="publisher"
                            :developer="developer"
                            :releaseDate="releaseDate" :description="description"/>
  </div>
  <DetailsScreenshots :screenshots="screenshots"/>
  <DetailsSystemRequirements :requirements="systemRequirements"/>
</template>

<script>
import Thumbnail from './components/DetailsThumbnail.vue';
import DescriptionMain from './components/DetailsDescriptionMain.vue';
import Screenshots from './components/DetailsScreenshots.vue'
import SystemRequirements from './components/DetailsSystemRequirements.vue';

export default {
  components: {
    DetailsThumbnail: Thumbnail,
    DetailsDescriptionMain: DescriptionMain,
    DetailsScreenshots: Screenshots,
    DetailsSystemRequirements: SystemRequirements
  },
  props: {
    gameId: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      thumbnailSource: '',
      playUrl: '',
      title: '',

      genre: '',
      platform: '',
      publisher: '',
      developer: '',
      releaseDate: '',
      description: '',

      screenshots: [],

      systemRequirements: {}
    }
  },
  methods: {
    async fetchData() {
      const url = 'http://lame.local/game-json/' + this.gameId;

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      let data = await response.json();

      this.thumbnailSource = data.thumbnail;
      this.playUrl = data.game_url;
      this.title = data.title;

      this.genre = data.genre;
      this.platform = data.platform;
      this.publisher = data.publisher;
      this.developer = data.developer;
      this.releaseDate = data.release_date;
      this.description = data.description;

      this.screenshots = data.screenshots;

      this.systemRequirements = data.minimum_system_requirements;
    },
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>

</style>