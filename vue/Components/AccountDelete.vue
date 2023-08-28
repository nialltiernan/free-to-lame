<template>
  <it-button type="danger" @click="showModal" class="btn-danger">Delete account</it-button>
  <it-modal v-model="isModalVisible">
    <template #header>
      <h3>Delete account</h3>
    </template>
    <template #body>
      Do you really want to delete your account? This cannot be undone.
    </template>
    <template #actions>
      <it-button @click="hideModal">Cancel</it-button>
      <it-button type="danger" @click="deleteAccount">Delete</it-button>
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
      isModalVisible: false,
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
    
    showModal() {
      this.isModalVisible = true;
    },

    hideModal() {
      this.isModalVisible = false;
    },

    showDeleteSuccessMessage() {
      this.$Notification.success({title: 'Successfully deleted account', text: 'You have deleted your account'})
    },
  }
}
</script>

<style scoped>

</style>