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
  },
  computed: {
    color() {
      return this.$store.getters.color;
    }
  }
}
</script>

<style scoped>

</style>