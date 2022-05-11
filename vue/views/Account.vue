<template>
  <div>
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
          <td :class="{ shake: usernameInput.status === 'danger'}">
            <it-input v-model="username" :status="usernameInput.status" :message="usernameInput.message"
                      suffix-icon="face"/>
          </td>
        </tr>
        <tr>
          <td>Email</td>
          <td :class="{ shake: emailInput.status === 'danger'}">
            <it-input v-model="email" :status="emailInput.status" :message="emailInput.message" suffix-icon="email"/>
          </td>
        </tr>
        <tr>
          <td>Favourite color</td>
          <td class="d-flex justify-content-between align-items-center flex-wrap">
            <it-colorpicker :disable-alpha="true" :value="color" @change="updateFavoriteColor"/>
            <LoadingSpinner :radius="46" :color="color"/>
          </td>
        </tr>
        <tr>
          <it-button type="primary">Update account</it-button>
        </tr>
        </tbody>
      </table>
    </form>

    <div v-else>
      <br>
      <LoadingSpinner :radius="46"/>
    </div>

    <it-divider/>

    <AccountDelete :user-id="userId"/>
  </div>
</template>

<script>
import LoadingSpinner from '../components/LoadingSpinner.vue';
import AccountDelete from '../components/AccountDelete.vue';

export default {
  components: {LoadingSpinner, AccountDelete},
  props: {
    userId: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      username: '',
      email: '',
      isLoaded: false,
      color: this.$store.getters.color,
      errors: {},
      inputStatus: {
        username: null,
        email: null
      },
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

      this.isLoaded = true;
    },

    updateFavoriteColor(color) {
      this.color = color.hex;
    },

    async updateAccount() {
      this.clearErrors();

      const url = BASE_URL + '/account/' + this.userId + '/update';

      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username: this.username,
          email: this.email,
          color: this.color
        })
      });

      if (response.status === 400) {
        this.showValidationFailedMessage();
        this.processErrors(await response.json())
        return;
      }

      if (!response.ok) {
        this.showErrorMessage();
        return;
      }

      this.$store.commit('color', this.color);

      this.setInputStatusSuccess();
      this.showAccountUpdatedMessage();
    },

    clearErrors() {
      this.errors = {};
      this.inputStatus.username = null;
      this.inputStatus.email = null;
    },

    setInputStatusSuccess() {
      for (let status in this.inputStatus) {
        this.inputStatus[status] = 'success';
      }
    },

    processErrors(errors) {
      for (let input in errors) {
        let inputErrors = errors[input];
        for (let inputError in inputErrors) {
          this.errors[input] = inputErrors[inputError];
        }
      }
    },

    showAccountUpdatedMessage() {
      this.$Notification.success({title: 'Account updated', text: 'You have updated your preferences'})
    },

    showValidationFailedMessage() {
      this.$Notification.warning({title: 'Validation failed', text: 'Please fix the input'})
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