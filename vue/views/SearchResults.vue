<template>
  <h1>Search Results:</h1>
  <h2>{{ subtitle }}</h2>

  <div v-if="isLoaded">
    <ul class="list-unstyled">
      <li v-for="game in games" :key="game.id" class="media pb-4 d-flex flex-wrap">
        <img :src="game.thumbnail" class="mr-3 rounded pb-2" :alt="game.title">
        <div class="media-body">
          <h5 class="mt-0 mb-1">
            <a :href="gameUrl(game)">{{ game.title }}</a>
          </h5>
          <p>{{ game.short_description }}</p>
        </div>
      </li>
    </ul>
  </div>

  <div v-else>
    <br>
    <LoadingSpinner :radius="64"/>
  </div>
</template>

<script>
import LoadingSpinner from '../components/LoadingSpinner.vue';

export default {
  components: {LoadingSpinner},
  props: {
    terms: {
      type: String,
      required: true
    },
    inject: ['color'],
  },
  data() {
    return {
      games: [],
      isLoaded: false,
    }
  },
  methods: {
    async fetchData() {
      const url = BASE_URL + '/search';

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: this.terms
      });

      let data = await response.json();

      this.isLoaded = true;
      this.games = data;
    },

    gameUrl(game) {
      return BASE_URL + '/game/' + game.id;
    }
  },
  computed: {
    subtitle() {
      let terms = this.terms.split(',');

      let titleCaseArray = terms.map(function (term) {
        return term[0].toUpperCase() + term.substr(1);
      })

      return titleCaseArray.join(', ');
    }
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>

</style>