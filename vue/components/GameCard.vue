<template>
  <div class="col">
    <div class="card shadow-sm">
      <img :src="game.thumbnail" class="img-fluid rounded" :alt="game.title">
      <div class="card-body">
        <p class="card-text">{{ shortDescription }}</p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="btn-group">
            <a :href="game.game_url" class="btn btn-sm btn-outline-secondary">Play now</a>
            <router-link :to="{ name: 'Game', params: { gameId:game.id} }"
                         class="btn btn-sm btn-outline-secondary">
              Details
            </router-link>
          </div>
          <small class="text-muted d-md-none d-lg-block">{{ game.release_date }}</small>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GameCard',
  props: {
    game: {
      type: Object,
      required: true
    },
  },
  computed: {
    shortDescription() {
      return this.game.short_description.substring(0, 110);
    }
  }
}
</script>

<style scoped>

</style>