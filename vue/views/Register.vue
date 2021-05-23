<template>
  <h1>Register</h1>

  <form @submit.prevent="register">
    <div class="form-group">
      <label class="visually-hidden" for="username">Username</label>
      <it-input v-model="username" id="username" class="form-control" type="text" name="username" placeholder="Username"
                :status="usernameInput.status" :message="usernameInput.message" suffix-icon="face"/>
    </div>

    <div class="form-group">
      <label class="visually-hidden" for="username">Email</label>
      <it-input v-model="email" id="email" class="form-control" type="email" name="email" placeholder="Email"
                :status="emailInput.status" :message="emailInput.message" suffix-icon="email"/>
    </div>

    <div class="form-group">
      <label class="visually-hidden" for="password">Password</label>
      <it-input v-model="password" id="password" class="form-control" type="password" name="password"
                :status="passwordInput.status" :message="passwordInput.message" placeholder="Password"
                suffix-icon="password"/>
    </div>

    <it-button type="primary">Register</it-button>
  </form>
</template>

<script>

export default {
  data() {
    return {
      username: '',
      email: '',
      password: '',
      errors: {},
      inputStatus: {
        username: null,
        email: null,
        password: null
      },
    }
  },
  methods: {
    async register() {
      this.clearErrors();

      const url = BASE_URL + '/register';

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username: this.username,
          email: this.email,
          password: this.password,
        })
      });

      if (response.status === 400) {
        this.showRegistrationFailedMessage();
        this.processErrors(await response.json())
        return;
      }

      if (!response.ok) {
        this.showErrorMessage();
        return;
      }

      this.showRegistrationSuccessMessage();

      let user = await response.json();
      this.$store.commit('logIn', user);
      await this.$router.push({name: 'Account', params: {userId: user.id, color: user.color}});
    },

    clearErrors() {
      this.errors = {};
      this.inputStatus.username = null;
      this.inputStatus.email = null;
      this.inputStatus.password = null;
    },

    processErrors(errors) {
      for (let input in errors) {
        let inputErrors = errors[input];
        for (let inputError in inputErrors) {
          this.errors[input] = inputErrors[inputError];
        }
      }
    },

    showRegistrationSuccessMessage() {
      this.$Notification.success({title: 'Registration successful', text: 'Thank you for creating an account'})
    },

    showRegistrationFailedMessage() {
      this.$Notification.warning({title: 'Registration failed', text: 'Please try again'})
    },

    showErrorMessage() {
      this.$Notification.danger({title: 'Oops!', text: 'Something has gone wrong'})
    }
  },
  computed: {
    usernameInput() {
      if ('username' in this.errors) {
        return {status: 'danger', message: this.errors.username};
      }
      return {status: this.inputStatus.username, message: null};
    },

    emailInput() {
      if ('email' in this.errors) {
        return {status: 'danger', message: this.errors.email};
      }
      return {status: this.inputStatus.email, message: null};
    },

    passwordInput() {
      if ('password' in this.errors) {
        return {status: 'danger', message: this.errors.password};
      }
      return {status: this.inputStatus.password, message: null};
    },
  },
}
</script>

<style scoped>

</style>