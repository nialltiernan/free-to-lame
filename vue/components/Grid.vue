<template>
  <div class="album py-2 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div v-for="game in games" :key="game.id">
          <GameCard :game="game"/>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import GameCard from './GameCard.vue';

export default {
  name: 'Grid',
  components: { GameCard},
  props: {
    games: {
      type: Array,
      required: true
    },
  }
}
</script>

<style scoped>

</style>