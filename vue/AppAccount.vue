<template>
  <h1>Account Overview</h1>

  <table v-if="isLoaded" class="table mt-5">
    <tbody>
    <tr>
      <td>Username</td>
      <td>{{ username }}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{ email }}</td>
    </tr>
    </tbody>
  </table>

  <div v-else>
    <br>
    <LoadingSpinner :radius="46" />
  </div>

  <it-divider />

  <AccountDelete :user-id="userId"/>
</template>

<script>
import LoadingSpinner from './components/LoadingSpinner.vue';
import AccountDelete from './components/AccountDelete.vue';

export default {
  components: {
    LoadingSpinner,
    AccountDelete
  },
  props: {
    userId: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      username: '',
      email: '',
    }
  },
  methods: {
    async fetchData() {
      const url = BASE_URL + '/account/' + this.userId + '/json';

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      let data = await response.json();

      this.username = data.username;
      this.email = data.email;
    },
  },
  computed: {
    isLoaded() {
      return this.username !== '';
    }
  },
  created() {
    this.fetchData()
  }
}
</script>

<style scoped>

</style>