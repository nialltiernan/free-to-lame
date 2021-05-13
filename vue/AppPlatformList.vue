<template>
  <h1 class="mb-4">Platforms</h1>

  <div class="row">
      <h2 class="col shadow-sm pb-2"><a :href="browser">Browser</a></h2>
      <h2 class="col shadow-sm pb-2"><a :href="pc">PC</a></h2>
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