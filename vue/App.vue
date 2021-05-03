<template>
  <section class="pb-2 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Free to play games</h1>
        <p class="lead text-muted">Most popular games that are free to play right now</p>
      </div>
    </div>
  </section>

  <Grid :games="games"/>
</template>

<script>
import Grid from './components/Grid.vue';

export default {
  components: { Grid },
  data() {
    return {
      games: [],
    }
  },
  methods: {
    async fetchData() {
      const url = BASE_URL + '/json';

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      this.games = await response.json();
    },
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>

</style>