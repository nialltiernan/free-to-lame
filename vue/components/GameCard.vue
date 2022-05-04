<template>
  <div class="col">
    <div class="card shadow-sm">
      <router-link :to="{ name: 'Game', params: { gameId:game.id} }" class="btn btn-sm btn-outline-secondary">
        <img :src="game.thumbnail" class="img-fluid rounded" :alt="game.title">
      </router-link>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <span class="badge badge-secondary mr-2 p-1">{{ game.genre }}</span>
          <router-link v-if="platformLogo" :to="{ name: 'Platform', params: {platform: routerPlatform} }">
            <img style="height: 1.5rem" :src="platformLogo" :alt="game.platform" />
          </router-link>
          <span v-else class="badge badge-secondary p-1">{{ game.platform }}</span>
        </div>
        <p class="card-text mt-1">{{ shortDescription }}</p>
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
  data() {
    return {
      platformLogo: null,
    }
  },
  computed: {
    shortDescription() {
      return this.game.short_description.substring(0, 50).trim() + '...';
    },
    isPlatformWindows() {
      return this.game.platform === 'PC (Windows)';
    },
    isPlatformBrowser() {
      return this.game.platform === 'Web Browser';
    },
    routerPlatform() {
      return this.isPlatformWindows ? 'pc' : 'browser';
    }
  },
  methods: {
    getWindowsLogo() {
      return BASE_URL + '/img/windows-logo.svg';
    },
    getBrowserLogo() {
      return BASE_URL + '/img/internet-monitor.svg';
    },
  },
  created() {
    if (this.isPlatformWindows) {
      this.platformLogo = this.getWindowsLogo();
    } else if (this.isPlatformBrowser) {
      this.platformLogo = this.getBrowserLogo();
    }
  }
}
</script>

<style scoped>

</style>