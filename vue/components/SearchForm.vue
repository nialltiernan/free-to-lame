<template>
  <form :action="searchResultsUrl" method="post" class="form-inline">
    <div id="search-form" class="mr-2" style="width: 250px"></div>
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</template>

<script>
export default {
  name: 'SearchForm',
  computed: {
    searchResultsUrl() {
      return BASE_URL + '/search-results';
    },
  }
}
</script>

<style scoped>

</style>