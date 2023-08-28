<template>
  <div>
    <h1 class="mb-4">Categories</h1>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'action'}}" class="col shadow-sm pb-2">
        <h2>Action</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'action-rpg'}}" class="col shadow-sm pb-2">
        <h2>Action RPG</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'anime'}}" class="col shadow-sm pb-2">
        <h2>Anime</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'battle-royale'}}" class="col shadow-sm pb-2">
        <h2>Battle Royale</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'card'}}" class="col shadow-sm pb-2">
        <h2>Card</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'fighting'}}" class="col shadow-sm pb-2">
        <h2>Fighting</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'first-person'}}" class="col shadow-sm pb-2">
        <h2>First Person</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'flight'}}" class="col shadow-sm pb-2">
        <h2>Flight</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'horror'}}" class="col shadow-sm pb-2">
        <h2>Horror</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'low-specs'}}" class="col shadow-sm pb-2">
        <h2>Low Specs</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'martial-arts'}}" class="col shadow-sm pb-2">
        <h2>Martial Arts</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'mmo'}}" class="col shadow-sm pb-2">
        <h2>MMO</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'mmofps'}}" class="col shadow-sm pb-2">
        <h2>MMO-FPS</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'mmorts'}}" class="col shadow-sm pb-2">
        <h2>MMO-RTS</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'mmorpg'}}" class="col shadow-sm pb-2">
        <h2>MMO-RPG</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'mmotps'}}" class="col shadow-sm pb-2">
        <h2>MMO-TPS</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'military'}}" class="col shadow-sm pb-2">
        <h2>Military</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'multiplayer-online-battle-arena'}}" class="col shadow-sm pb-2">
        <h2>Online Battle Arena</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'open-world'}}" class="col shadow-sm pb-2">
        <h2>Open World</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'permadeath'}}" class="col shadow-sm pb-2">
        <h2>Permadeath</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'pixel'}}" class="col shadow-sm pb-2">
        <h2>Pixel</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'pve'}}" class="col shadow-sm pb-2">
        <h2>PVE</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'pvp'}}" class="col shadow-sm pb-2">
        <h2>PVP</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'racing'}}" class="col shadow-sm pb-2">
        <h2>Racing</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'sailing'}}" class="col shadow-sm pb-2">
        <h2>Sailing</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'sandbox'}}" class="col shadow-sm pb-2">
        <h2>Sandbox</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'sci-fi'}}" class="col shadow-sm pb-2">
        <h2>Sci-Fi</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'shooter'}}" class="col shadow-sm pb-2">
        <h2>Shooter</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'side-scroller'}}" class="col shadow-sm pb-2">
        <h2>Side Scroller</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'social'}}" class="col shadow-sm pb-2">
        <h2>Social</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'space'}}" class="col shadow-sm pb-2">
        <h2>Space</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'sports'}}" class="col shadow-sm pb-2">
        <h2>Sports</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'strategy'}}" class="col shadow-sm pb-2">
        <h2>Strategy</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'superhero'}}" class="col shadow-sm pb-2">
        <h2>Superhero</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'survival'}}" class="col shadow-sm pb-2">
        <h2>Survival</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'tank'}}" class="col shadow-sm pb-2">
        <h2>Tank</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'third-person'}}" class="col shadow-sm pb-2">
        <h2>Third Person</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'top-down'}}" class="col shadow-sm pb-2">
        <h2>Top Down</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'tower-defense'}}" class="col shadow-sm pb-2">
        <h2>Tower Defense</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'turn-based'}}" class="col shadow-sm pb-2">
        <h2>Turn Based</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'two-dimension'}}" class="col shadow-sm pb-2">
        <h2>2D</h2>
      </router-link>

      <router-link :to="{ name: 'Category', params: {category: 'voxel'}}" class="col shadow-sm pb-2">
        <h2>Voxel</h2>
      </router-link>
    </div>

    <div class="row mb-3">
      <router-link :to="{ name: 'Category', params: {category: 'zombie'}}" class="col shadow-sm pb-2">
        <h2>Zombie</h2>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>

</style>