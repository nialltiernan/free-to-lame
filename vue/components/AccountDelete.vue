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
    async deleteAccount() {
      await this.$router.push({name: 'Home'})

      this.$store.commit('logOut');

      const URL = BASE_URL + '/account/' + this.userId + '/delete';

      let response = await fetch(URL);

      if (!response.ok) {
        alert('Something has gone wrong');
        return;
      }

      this.showDeleteSuccessMessage();
    },

    showDeleteSuccessMessage() {
      this.$Notification.success({title: 'Successfully deleted account', text: 'You have deleted your account'})
    },
  }
}
</script>

<style scoped>

</style>