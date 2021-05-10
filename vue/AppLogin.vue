<template>

  <div v-if="invalidCredentials" class="alert alert-danger" role="alert">
    Invalid credentials <button class="badge badge-secondary" @click="invalidCredentials = false">close</button>
  </div>

  <h1>Login</h1>

  <form @submit.prevent="login">
    <div class="form-group">
      <label class="visually-hidden" for="username">Username</label>
      <it-input v-model="username" id="username" class="form-control" type="text" name="username" placeholder="Username"
                suffix-icon="face"/>
    </div>

    <div class="form-group">
      <label class="visually-hidden" for="password">Password</label>
      <it-input v-model="password" id="password" class="form-control" type="password" name="password"
                placeholder="Password" suffix-icon="password"/>
    </div>

    <input class="btn btn-primary" type="submit" name="submit" value="Login"/>
  </form>
</template>

<script>

export default {
  data() {
    return {
      username: '',
      password: '',
      invalidCredentials: false,
    }
  },
  methods: {
    async login() {
      const url = BASE_URL + '/login';

      let credentials = {
        username: this.username,
        password: this.password
      };

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(credentials)
      });

      if (response.status === 200) {
        window.location.href = BASE_URL;
      }

      if (response.status === 401) {
        this.invalidCredentials = true
      } else if (!response.ok) {
        alert('HTTP-Error: ' + response.status);
        console.log(response.statusText);
      }
    },
  },
}
</script>

<style scoped>

</style>