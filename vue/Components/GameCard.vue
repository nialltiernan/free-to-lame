<template>
  <div class="col mb-3">
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
        <div class="d-flex justify-content-between align-items-end">
          <p class="card-text mt-1">{{ showDescription }}</p>
          <img v-if="!showFullDescription" @click="showMore" :src="eyeImage" alt="show more" style="height: 1.5rem"/>
          <img v-else @click="showLess" :src="eyeImage" alt="show less" style="height: 1.5rem" />
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
  data() {
    return {
      platformLogo: null,
      showFullDescription: false,
      eyeImage: this.getImageEyeEnabled()
    }
  },
  computed: {
    showDescription() {
      return this.showFullDescription ? this.game.short_description : this.miniDescription;
    },
    miniDescription() {
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
    getImageWindowsLogo() {
      return BASE_URL + '/img/windows-logo.svg';
    },
    getImageBrowserLogo() {
      return BASE_URL + '/img/internet-monitor.svg';
    },
    getImageEyeEnabled() {
      return BASE_URL + '/img/eye-enabled.png';
    },
    getImageEyeDisabled() {
      return BASE_URL + '/img/eye-disabled.png';
    },
    showMore() {
      this.showFullDescription = true;
      this.eyeImage = this.getImageEyeDisabled();
    },
    showLess() {
      this.showFullDescription = false;
      this.eyeImage = this.getImageEyeEnabled();
    }
  },
  created() {
    if (this.isPlatformWindows) {
      this.platformLogo = this.getImageWindowsLogo();
    } else if (this.isPlatformBrowser) {
      this.platformLogo = this.getImageBrowserLogo();
    }
  }
}
</script>

<style scoped>

</style>