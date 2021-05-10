<template>
  <div v-if="isLoaded" class="album py-2 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div v-for="game in games" :key="game.id">
          <GameCard :game="game"/>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <br><br>
    <LoadingSpinner :radius="64" :color="color" />
    <br><br>
  </div>
</template>

<script>
import GameCard from './GameCard.vue';
import LoadingSpinner from './LoadingSpinner.vue';

export default {
  name: 'GameGrid',
  components: {
    GameCard,
    LoadingSpinner
  },
  props: {
    games: {
      type: Array,
      required: true
    },
    color: {
      type: String,
      default: 'blue'
    }
  },
  computed: {
    isLoaded() {
      return this.games.length;
    }
  }
}
</script>

<style scoped>

</style>