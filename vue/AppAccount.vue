<template>

  <div v-if="success" class="alert alert-success" role="alert">
    Account updated! <button class="badge badge-secondary" @click="success = false">close</button>
  </div>

  <div v-if="fail" class="alert alert-danger" role="alert">
    Failed to update account! <button class="badge badge-secondary" @click="fail = false">close</button>
  </div>

  <h1>
    <it-avatar size="70px" :color="color"/>
    My Account
  </h1>
  <h2>
    Welcome,
    <span v-if="isLoaded" class="d-inline-block">{{ username }}</span>
    <span v-else class="d-inline-block"><it-loading :radius="15" :stroke="4" :color="color"/> </span>
  </h2>

  <form v-if="isLoaded" @submit.prevent="updateAccount">
    <table class="table mt-5">
      <tbody>
      <tr>
        <td>Username</td>
        <td>
          <it-input v-model="username" suffix-icon="face"/>
        </td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{ email }}</td>
      </tr>
      <tr>
        <td>Favourite color</td>
        <td>
          <it-colorpicker :disable-alpha="true" :value="color" @change="updateFavoriteColor"/>
        </td>
      </tr>
      <tr>
        <input class="btn-primary" type="submit" value="Update account">
      </tr>
      </tbody>
    </table>
  </form>

  <div v-else>
    <br>
    <LoadingSpinner :radius="46" :color="color"/>
  </div>

  <it-divider/>

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
    },
    color: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      username: '',
      email: '',
      success: false,
      fail: false
    }
  },
  methods: {
    async fetchData() {
      const url = BASE_URL + '/account/' + this.userId + '/json';

      let response = await fetch(url);

      if (!response.ok) {
        alert('HTTP-Error: ' + response.status);
        return;
      }

      let data = await response.json();

      this.username = data.username;
      this.email = data.email;
      this.color = data.color;
    },
    updateFavoriteColor(val) {
      this.color = val.hex;
    },
    async updateAccount() {
      const url = BASE_URL + '/account/' + this.userId + '/update';

      let user = {
        username: this.username,
        color: this.color
      };

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
      });

      if (!response.ok) {
        alert('HTTP-Error: ' + response.status);
        console.log(response.statusText);
        this.fail = true
        return;
      }

      this.success = true;
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
h1 {
}
</style>