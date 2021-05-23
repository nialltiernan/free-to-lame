<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3" role="navigation">
    <div class="container">
      <router-link class="navbar-brand" :to="{ name: 'Home' }">FreeToPlay</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" id="navbarCategoriesDropdown" role="button" style="cursor: pointer"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </span>
            <div class="dropdown-menu" aria-labelledby="navbarCategoriesDropdown">
              <router-link class="dropdown-item" :to="{ name: 'Categories' }">See all
              </router-link>
              <div class="dropdown-divider"></div>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: {category: 'action'} }">
                Action
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: {category: 'action-rpg'} }">Action RPG
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'anime'} }">
                Anime
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'battle-royale'} }">Battle Royale
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'card'} }">
                Card
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'fighting'} }">Fighting
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'first-person'} }">First Person
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'flight'} }">Flight
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'horror'} }">Horror
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'low-specs'} }">Low Specs
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'martial-arts'} }">Martial Arts
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'mmo'} }">
                MMO
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'mmofps'} }">MMO-FPS
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'mmorts'} }">MMO-RTS
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'mmorpg'} }">MMO-RPG
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'mmotps'} }">MMO-TPS
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'military'} }">Military
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'multiplayer-online-battle-arena'} }">
                Online Battle Arena
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'open-world'} }">Open World
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'permadeath'} }">Permadeath
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'pixel'} }">
                Pixel
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'pve'} }">
                PVE
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'pvp'} }">
                PVP
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'racing'} }">Racing
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'sailing'} }">Sailing
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'sandbox'} }">Sandbox
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'sci-fi'} }">Sci-Fi
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'shooter'} }">Shooter
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'side-scroller'} }">Side Scroller
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'social'} }">Social
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'space'} }">
                Space
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'sports'} }">Sports
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'strategy'} }">Strategy
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'superhero'} }">Superhero
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'survival'} }">Survival
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'tank'} }">
                Tank
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'third-person'} }">Third Person
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'top-down'} }">Top Down
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'tower-defense'} }">Tower Defense
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'turn-based'} }">Turn Based
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'two-dimension'} }">2D
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Category', params: { category: 'voxel'} }">
                Voxel
              </router-link>
              <router-link class="dropdown-item"
                           :to="{ name: 'Category', params: { category: 'zombie'} }">Zombie
              </router-link>

            </div>
          </li>
          <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" id="navbarPlatformsDropdown" role="button" style="cursor: pointer"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Platforms
            </span>
            <div class="dropdown-menu" aria-labelledby="navbarPlatformsDropdown">
              <router-link class="dropdown-item" :to="{ name: 'Platforms'}">See all
              </router-link>
              <div class="dropdown-divider"></div>
              <router-link class="dropdown-item"
                           :to="{ name: 'Platform', params: {platform: 'browser'} }">Browser
              </router-link>
              <router-link class="dropdown-item" :to="{ name: 'Platform', params: {platform: 'pc'} }">PC
              </router-link>
            </div>
          </li>

          <li v-if="isLoggedIn" class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Account', params: {userId: userId}}">Account
            </router-link>
          </li>
          <li v-if="isLoggedIn" class="nav-item">
            <LogoutButton/>
          </li>

          <li v-if="!isLoggedIn" class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Register' }">Register</router-link>
          </li>
          <li v-if="!isLoggedIn" class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Login' }">Login</router-link>
          </li>

        </ul>
        <SearchForm/>
      </div>
    </div>
  </nav>
</template>

<script>
import SearchForm from './SearchForm.vue';
import LogoutButton from './LogoutButton.vue';

export default {
  name: 'Navigation',
  components: {SearchForm, LogoutButton},
  data() {
    return {
      userColor: null
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
    userId() {
      return this.$store.getters.loggedInUser.id;
    }
  },
}
</script>

<style scoped>

</style>