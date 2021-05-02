<template>
  <div class="row justify-content-between align-items-center pb-3 px-4">
    <h1>{{ titleCase }}</h1>

    <div class="d-flex flex-row-reverse">
      hello
    </div>
  </div>
  <Grid :games="games"/>
</template>

<script>
import Grid from './components/Grid.vue';

export default {
  components: {
    Grid
  },
  props: {
    category: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      games: [],
    }
  },
  methods: {
    async fetchData() {
      const url = BASE_URL + '/category/' + this.category + '/json';

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      this.games = await response.json();
    },
  },
  computed: {
    titleCase() {
      return this.category[0].toUpperCase() + this.category.substring(1);
    }
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>
 h1 {}
</style>