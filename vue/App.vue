<template>
  <Navigation/>

  <div class="container">
    <router-view/>
    <Footer/>
  </div>
</template>

<script>
import Navigation from './components/Navigation.vue';
import Footer from './components/Footer.vue';

export default {
  components: {Navigation, Footer},
  props: {
    color: {
      type: String,
      required: true
    }
  },
  provide() {
    return {
      color: this.color
    }
  },
}
</script>

<style scoped>

</style>