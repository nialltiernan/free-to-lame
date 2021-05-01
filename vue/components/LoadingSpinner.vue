<template>
  <section class="text-center">
    <it-loading :radius="radius"></it-loading>
  </section>
</template>

<script>
export default {
  name: 'LoadingSpinner',
  props: {
    radius : {
      type: Number,
      default: 32
    }
  }
}
</script>

<style scoped>

</style>