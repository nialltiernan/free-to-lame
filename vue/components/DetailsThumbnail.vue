<template>
  <div class="col-md-6">
    <div class="row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <img :src="source" class="rounded mx-auto img-thumbnail" alt="ThumbnailImage">
        <form method="GET" :action="playUrl" class="mx-auto mt-3">
          <input type="submit" class="btn btn-primary py-2 px-4" value="Play now!">
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailsThumbnail',
  props: {
    source: {
      type: String,
      required: true
    },
    playUrl: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>