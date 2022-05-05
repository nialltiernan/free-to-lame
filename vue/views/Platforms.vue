<template>
  <div>
    <h1 class="mb-4">Platforms</h1>

    <div class="row">
      <h2 class="col shadow-sm pb-2 d-flex justify-content-between align-items-end">
        <router-link :to="{ name: 'Platform', params: {platform: 'browser'}}">Browser</router-link>
        <img :src="browserImage" alt="browser" style="height: 2rem" class="ml-3" />
      </h2>
      <h2 class="col shadow-sm pb-2 d-flex justify-content-between align-items-end">
        <router-link :to="{ name: 'Platform', params: {platform: 'pc'}}">PC</router-link>
        <img :src="windowsImage" alt="pc" style="height: 2rem" class="ml-3" />
      </h2>
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