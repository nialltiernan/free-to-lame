<template>
  <div v-if="areGamesLoaded" class="album py-2 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div v-for="game in games" :key="game.id">
          <GameCard :game="game"/>
        </div>
      </div>
    </div>
  </div>

  <LoadingSpinner v-else />
</template>

<script>
import GameCard from './GameCard.vue';
import LoadingSpinner from './LoadingSpinner.vue';

export default {
  name: 'Grid',
  components: {
    GameCard,
    LoadingSpinner
  },
  props: {
    games: {
      type: Array,
      required: true
    },
  },
  computed: {
    areGamesLoaded() {
      return this.games.length
    }
  }
}
</script>

<style scoped>

</style>