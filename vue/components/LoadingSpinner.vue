<template>
  <section class="text-center">
    <it-loading :radius="radius" :color="color"></it-loading>
  </section>
</template>

<script>
export default {
  name: 'LoadingSpinner',
  props: {
    radius : {
      type: Number,
      default: 32
    },
    color: {
      type: String,
      default: 'blue'
    }
  }
}
</script>

<style scoped>

</style>