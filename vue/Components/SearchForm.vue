<template>
  <form @submit.prevent="onSubmit" method="post" class="form-inline">
    <div id="search-form" class="mr-2" style="width: 250px"></div>
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</template>

<script>
export default {
  name: 'SearchForm',
  methods: {
    onSubmit() {
      let terms = document.querySelector('#search-form').value;

      if (!terms.length) {
        this.showInvalidSearchTermsMessage();
        return;
      }

      this.$router.push({name: 'SearchResults', params: {terms: terms}});
    },

    showInvalidSearchTermsMessage() {
      this.$Notification.warning({
        title: 'No search terms selected',
        text: 'Check some of the boxes to search',
        placement: 'top-left'
      })
    },
  }
}
</script>

<style scoped>

</style>