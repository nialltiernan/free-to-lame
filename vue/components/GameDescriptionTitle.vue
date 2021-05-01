<template>
  <div class="d-flex align-items-end">
    <h1>{{ title }}</h1>
  </div>

  <p class="small text-muted">
    {{ genre }}
    {{ platform }}
    {{ publisher }}
    {{ developer }}
    {{ releaseDate }}
  </p>
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
  }
}
</script>

<style scoped>

</style>