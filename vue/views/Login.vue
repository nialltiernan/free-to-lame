<template>
  <h1>Login</h1>

  <form @submit.prevent="login">
    <div class="form-group">
      <label class="visually-hidden" for="username">Username</label>
      <it-input v-model="username" id="username" class="form-control" type="text" name="username" placeholder="Username"
                :status="inputStatus.username" suffix-icon="face"/>
    </div>

    <div class="form-group">
      <label class="visually-hidden" for="password">Password</label>
      <it-input v-model="password" id="password" class="form-control" type="password" name="password"
                :status="inputStatus.password" placeholder="Password" suffix-icon="password"/>
    </div>

    <it-button type="primary">Login</it-button>
  </form>
</template>

<script>

export default {
  data() {
    return {
      username: '',
      password: '',
      inputStatus: {
        username: null,
        password: null
      },
    }
  },
  methods: {
    async login() {
      const url = BASE_URL + '/login';

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username: this.username,
          password: this.password
        })
      });

      if (response.status === 401) {
        this.setInputStatusDanger();
        this.showInvalidCredentialsMessage();
        return;
      }

      if (!response.ok) {
        alert('Something has gone wrong')
        return;
      }

      this.showLoginSuccessMessage();

      let user = await response.json();
      this.$store.commit('logIn', user);
      await this.$router.push({name: 'Account', params: {userId: user.id, color: user.color}});
    },

    setInputStatusDanger() {
      for (let status in this.inputStatus) {
        this.inputStatus[status] = 'danger';
      }
    },

    showInvalidCredentialsMessage() {
      this.$Notification.warning({
        title: 'Invalid credentials',
        text: 'You cannot log in because you have entered invalid credentials'
      })
    },

    showLoginSuccessMessage() {
      this.$Notification.success({title: 'Successfully logged in', text: 'You have logged in'});
    }
  },
}
</script>

<style scoped>

</style>