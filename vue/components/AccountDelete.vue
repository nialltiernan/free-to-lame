<template>
  <button @click="confirmModal = true" class="btn-danger">Delete account</button>
  <it-modal v-model="confirmModal">
    <template #header>
      <h3>Delete account</h3>
    </template>
    <template #body>
      Do you really want to delete your account? This cannot be undone.
    </template>
    <template #actions>
      <button @click="confirmModal = false">Cancel</button>
      <button class="btn-danger" @click="deleteAccount">Delete</button>
    </template>
  </it-modal>
</template>

<script>
export default {
  name: 'AccountDelete',
  props: {
    userId: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      confirmModal: false,
    }
  },
  methods: {
    deleteAccount() {
      document.location = BASE_URL + '/account/' + this.userId + '/delete';
    }
  }
}
</script>

<style scoped>

</style>