<template>
  <div>
    <h1 class="mb-4">Platforms</h1>

    <div class="row">
      <router-link
          :to="{ name: 'Platform', params: {platform: 'browser'}}"
          class="col shadow-sm pb-2 d-flex justify-content-between align-items-center">
        <h2>Browser</h2>
        <img :src="browserImage" alt="browser" style="height: 2rem" class="ml-3" />
      </router-link>

      <router-link
          :to="{ name: 'Platform', params: {platform: 'pc'}}"
          class="col shadow-sm pb-2 d-flex justify-content-between align-items-center">
        <h2>PC</h2>
        <img :src="windowsImage" alt="pc" style="height: 2rem" class="ml-3" />
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    windowsImage() {
      return BASE_URL + '/img/windows-logo.svg';
    },
    browserImage() {
      return BASE_URL + '/img/internet-monitor.svg';
    },
  },
}
</script>

<style scoped>

</style>