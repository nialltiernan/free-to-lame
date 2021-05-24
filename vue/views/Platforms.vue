<template>
  <div>
    <h1 class="mb-4">Platforms</h1>

    <div class="row">
      <h2 class="col shadow-sm pb-2">
        <router-link :to="{ name: 'Platform', params: {platform: 'browser'}}">Browser</router-link>
      </h2>
      <h2 class="col shadow-sm pb-2">
        <router-link :to="{ name: 'Platform', params: {platform: 'pc'}}">PC</router-link>
      </h2>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    pc() {
      return BASE_URL + '/platform/pc'
    },
    browser() {
      return BASE_URL + '/platform/browser'
    }
  },
}
</script>

<style scoped>

</style>