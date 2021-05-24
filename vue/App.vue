<template>
  <Navigation/>

  <div class="container">
    <router-view v-slot="{ Component }">
      <transition name="view" mode="out-in" appear>
        <component :is="Component"/>
      </transition>
    </router-view>

    <Footer/>
  </div>
</template>

<script>
import Navigation from './components/Navigation.vue';
import Footer from './components/Footer.vue';

export default {
  components: {Navigation, Footer},
}
</script>

<style scoped>
.view-enter-active {
  transition: all 0.25s ease-out;

}

.view-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.view-enter-from,
.view-leave-to {
  transform: translateX(20px);
  opacity: 0;
}

</style>