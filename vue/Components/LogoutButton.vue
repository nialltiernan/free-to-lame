<template>
  <a class="nav-link" @click.stop="logOut" href="#">Logout</a>
</template>

<script>
export default {
  name: 'LogoutButton',
  methods: {
    async logOut() {
      await this.$router.push({name: 'Home'})

      this.$store.commit('logOut');

      const URL = BASE_URL + '/logout';

      let response = await fetch(URL);

      if (!response.ok) {
        alert('Something has gone wrong');
        return;
      }

      this.showLogOutSuccessMessage();
    },

    showLogOutSuccessMessage() {
      this.$Notification.success({title: 'Successfully logged out', text: 'You have logged out'})
    },
  },

}
</script>

<style scoped>

</style>