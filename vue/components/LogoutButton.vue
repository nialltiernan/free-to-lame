<template>
  <a class="nav-link" @click.stop="logOut" href="#">Logout</a>
</template>

<script>
export default {
  name: 'LogoutButton',
  methods: {
    async logOut() {
      const URL = BASE_URL + '/logout';

      let response = await fetch(URL);

      if (!response.ok) {
        alert('Something has gone wrong');
      }

      this.showLogOutSuccessMessage();
      this.$store.commit('logOut');
      await this.$router.push({name: 'Home'})
    },

    showLogOutSuccessMessage() {
      this.$Notification.success({title: 'Successfully logged out', text: 'You have logged out'})
    },
  },

}
</script>

<style scoped>

</style>