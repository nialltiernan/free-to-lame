<template>
  <div class="mt-5">
    <div class="d-flex justify-content-between align-items-center">
      <h2>System requirements</h2>
      <img :src="logo" alt="System requirements">
    </div>

    <table class="table">

      <tbody>
      <tr v-for="(value, key) in requirements" :key="key">
        <td>{{ titleCase(key) }}</td>
        <td>{{ value }}</td>
      </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
export default {
  name: 'GameSystemRequirements',
  props: {
    requirements: {
      type: Object,
      required: true
    }
  },
  methods: {
    titleCase(string) {
      if (string === 'os') {
        return 'OS';
      }
      return string[0].toUpperCase() + string.substring(1);
    }
  },
  computed: {
    logo() {
      return BASE_URL + '/img/system.png';
    }
  }
}
</script>

<style scoped>

</style>