<template>
  <div>
    <div class="row">
      <GameThumbnail :source="thumbnailSource" :play-url="playUrl"/>
      <GameDescriptionMain :title="title" :genre="genre" :platform="platform" :publisher="publisher"
                           :developer="developer" :releaseDate="releaseDate" :description="description"/>
    </div>
    <GameScreenshots :screenshots="screenshots"/>
    <GameSystemRequirements v-if="hasRequirements" :requirements="systemRequirements"/>
  </div>
</template>

<script>
import GameThumbnail from '../Components/GameThumbnail.vue';
import GameDescriptionMain from '../Components/GameDescriptionMain.vue';
import GameScreenshots from '../Components/GameScreenshots.vue'
import GameSystemRequirements from '../Components/GameSystemRequirements.vue';

export default {
  components: {GameThumbnail, GameDescriptionMain, GameScreenshots, GameSystemRequirements},
  props: {
    gameId: {
      type: String,
      required: true
    },
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
      const url = BASE_URL + '/game/' + this.gameId + '/json';

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

      this.screenshots = data.screenshots ?? [];

      this.systemRequirements = data.minimum_system_requirements ?? {};
    },
  },
  computed: {
    hasRequirements() {
      for (let requirement in this.systemRequirements) {
        return true;
      }
      return false;
    }
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>

</style>