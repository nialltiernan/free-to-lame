<template>
  <div v-if="requirements" class="mt-5">
    <h2>System requirements</h2>

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
  }
}
</script>

<style scoped>

</style>