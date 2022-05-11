<template>
  <div>
    <h1>Search Results:</h1>
    <h2>{{ subtitle }}</h2>

    <div v-if="isLoaded">
      <GameGrid :games="games"/>
    </div>

    <div v-else>
      <br>
      <LoadingSpinner :radius="64"/>
    </div>
  </div>
</template>

<script>
import LoadingSpinner from '../components/LoadingSpinner.vue';
import GameGrid from '../components/GameGrid.vue';

export default {
  components: {LoadingSpinner, GameGrid},
  props: {
    terms: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
      games: [],
      activeTerms: [],
    }
  },
  methods: {
    async fetchData() {
      this.clearGames();

      const url = BASE_URL + '/search';

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.activeTerms)
      });

      this.games = await response.json();
    },

    initActiveTerms() {
      this.activeTerms = this.terms;
    },

    updateActiveTerms(terms) {
      this.activeTerms = terms
    },

    clearGames() {
      this.games = [];
    },
  },
  computed: {
    subtitle() {
      let titleCaseArray = this.terms.map(function (term) {
        return term[0].toUpperCase() + term.substr(1);
      })

      return titleCaseArray.join(', ');
    },

    isLoaded() {
      return this.games.length;
    }
  },
  created() {
    this.initActiveTerms();

    this.fetchData();

    this.$watch(() => this.$route.params, (params) => {
      this.updateActiveTerms(params.terms);
      this.fetchData();
    });
  }
}
</script>

<style scoped>

</style>