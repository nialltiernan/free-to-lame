<template>
  <div class="row justify-content-between align-items-center pb-3 px-4">
    <h1>{{ renderTitle }}</h1>

    <div class="d-flex flex-row-reverse">
      <it-select placeholder="Sort by" v-model="sortByValue" :options="sortByOptions" @change="reloadData"/>
    </div>
  </div>
  <Grid :games="games"/>
</template>

<script>
import Grid from './components/Grid.vue';

export default {
  components: {Grid},
  props: {
    platform: {
      type: String,
      required: true
    }
  },
  data() {
    return {
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
      const url = BASE_URL + '/platform/' + this.platform + '/json?sort-by=' + sortBy;

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      this.games = await response.json();
    },
  },
  computed: {
    renderTitle() {
      if (this.platform === 'pc') {
        return 'PC';
      }
      return this.platform[0].toUpperCase() + this.platform.substr(1);
    },
    reloadData() {
      if (!this.sortByValue) {
        return;
      }
      this.fetchData(this.sortByValue.value)
    }
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>
h1 {
}
</style>