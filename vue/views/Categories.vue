<template>
  <h1 class="mb-4">Categories</h1>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'action'}}">Action</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'action-rpg'}}">Action RPG
      </router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'anime'}}">Anime</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'battle-royale'}}">Battle Royale</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'card'}}">Card</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'fighting'}}">Fighting</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'first-person'}}">First Person</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'flight'}}">Flight</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'horror'}}">Horror</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'low-specs'}}">Low Specs</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'martial-arts'}}">Martial Arts</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'mmo'}}">MMO</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'mmofps'}}">MMO-FPS</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'mmorts'}}">MMO-RTS</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'mmorpg'}}">MMO-RPG</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'mmotps'}}">MMO-TPS</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'military'}}">Military</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'multiplayer-online-battle-arena'}}">Online Battle
        Arena
      </router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'open-world'}}">Open World</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'permadeath'}}">Permadeath</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'pixel'}}">Pixel</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'pve'}}">PVE</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'pvp'}}">PVP</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'racing'}}">Racing</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'sailing'}}">Sailing</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'sandbox'}}">Sandbox</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'sci-fi'}}">Sci-Fi</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'shooter'}}">Shooter</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'side-scroller'}}">Side Scroller</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'social'}}">Social</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'space'}}">Space</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'sports'}}">Sports</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'strategy'}}">Strategy</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'superhero'}}">Superhero</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'survival'}}">Survival</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'tank'}}">Tank</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'third-person'}}">Third Person</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'top-down'}}">Top Down</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'tower-defense'}}">Tower Defense</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'turn-based'}}">Turn Based</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'two-dimension'}}">2D</router-link>
    </h2>
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'voxel'}}">Voxel</router-link>
    </h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2">
      <router-link :to="{ name: 'Category', params: {category: 'zombie'}}">Zombie</router-link>
    </h2>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>

</style>