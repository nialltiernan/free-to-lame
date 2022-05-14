<template>
  <div>
    <div class="row justify-content-between align-items-center pb-3 px-4">
      <div class="d-flex align-items-center">
        <h1>{{ header }}</h1>
        <img :src="headerImage" :alt="header" class="ml-3" style="height: 2rem" />
      </div>
      <it-select placeholder="Sort by" v-model="sortByValue" :options="sortByOptions" @change="reloadData"/>
    </div>
    <GameGrid :games="games"/>
  </div>
</template>

<script>
import GameGrid from '../components/GameGrid.vue';

export default {
  components: {GameGrid},
  props: {
    platform: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      activePlatform: null,
      games: [],
      sortByValue: null,
      sortByOptions: [
        {
          'name': 'Alphabetical', 'value': 'alphabetical'
        },
        {
          'name': 'Popularity', 'value': 'popularity'
        },
        {
          'name': 'Release Date', 'value': 'release-date'
        },
        {
          'name': 'Relevance', 'value': 'relevance'
        },
      ],
    }
  },
  methods: {
    async fetchData(sortBy = 'popularity') {
      this.clearGames();

      const url = BASE_URL + '/platform/' + this.activePlatform + '/json?sort-by=' + sortBy;

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      this.games = await response.json();
    },

    initActivePlatform() {
      this.activePlatform = this.updateActivePlatform(this.platform);
    },

    updateActivePlatform(platform) {
      this.activePlatform = platform;
    },

    clearGames() {
      this.games = [];
    },

    clearSortBy() {
      this.sortByValue = null;
    }
  },
  computed: {
    header() {
      return this.isPlatformPc ? this.headerPc : this.headerBrowser;
    },
    isPlatformPc() {
      return this.platform === 'pc';
    },
    headerPc() {
      return 'PC';
    },
    headerBrowser() {
      return this.platform[0].toUpperCase() + this.platform.substr(1);
    },
    headerImage() {
      return this.isPlatformPc ? this.windowsImage : this.browserImage;
    },
    windowsImage() {
      return BASE_URL + '/img/windows-logo.svg';
    },
    browserImage() {
      return BASE_URL + '/img/internet-monitor.svg';
    },
    reloadData() {
      if (!this.sortByValue) {
        return;
      }
      this.fetchData(this.sortByValue.value)
    },
  },
  created() {
    this.initActivePlatform();

    this.fetchData();

    this.$watch(() => this.$route.params, (params) => {
        this.updateActivePlatform(params.platform);
        this.clearSortBy();
        this.fetchData();
    });
  }
}
</script>

<style scoped>

</style>