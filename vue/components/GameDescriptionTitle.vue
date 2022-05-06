<template>
  <div class="d-flex justify-content-between align-items-center flex-wrap">
    <h1>{{ title }}</h1>

    <router-link v-if="platformLogo" :to="{ name: 'Platform', params: {platform: routerPlatform} }">
      <img style="height: 1.5rem" :src="platformLogo" :alt="platform" />
    </router-link>
    <span v-else class="badge badge-secondary mx-1 mt-1">{{ platform }}</span>
  </div>

  <div class="d-flex flex-wrap mb-2">
    <span class="badge badge-secondary mr-2 mt-1 p-1">{{ genre }}</span>
    <span class="badge badge-secondary mr-2 mt-1 p-1">{{ publisher }}</span>
    <span class="badge badge-secondary mr-2 mt-1 p-1">{{ developer }}</span>
    <span class="badge badge-secondary mt-1 p-1">{{ releaseDate }}</span>
  </div>
</template>

<script>
export default {
  name: 'GameDescriptionTitle',
  props: {
    title: {
      type: String,
      required: true
    },
    genre: {
      type: String,
      required: true
    },
    platform: {
      type: String,
      required: true
    },
    publisher: {
      type: String,
      required: true
    },
    developer: {
      type: String,
      required: true
    },
    releaseDate: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      platformLogo: null,
    }
  },
  computed: {
    isPlatformWindows() {
      return this.platform === 'Windows';
    },
    isPlatformBrowser() {
      return this.platform === 'Web Browser';
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