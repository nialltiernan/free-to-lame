<template>
  <section class="text-center">
    <it-loading :radius="radius" :color="loadingColor"></it-loading>
  </section>
</template>

<script>
export default {
  name: 'LoadingSpinner',
  data() {
    return {
      loadingColor: null
    }
  },
  props: {
    radius : {
      type: Number,
      default: 32
    },
  },
  inject: ['color'],
  created() {
    this.loadingColor = this.color;
  }
}
</script>

<style scoped>

</style>