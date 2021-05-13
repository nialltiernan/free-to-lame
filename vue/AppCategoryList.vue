<template>
  <h1 class="mb-4">Categories</h1>

  <div class="row mb-3">
      <h2 class="col shadow-sm pb-2"><a :href="action">Action</a></h2>
      <h2 class="col shadow-sm pb-2"><a :href="actionRolePlayingGame">Action RPG</a></h2>
      <h2 class="col shadow-sm pb-2"><a :href="anime">Anime</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="battleRoyale">Battle Royale</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="card">Card</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="fighting">Fighting</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="firstPerson">First Person</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="flight">Flight</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="horror">Horror</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="lowSpecs">Low Specs</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="martialArts">Martial Arts</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="mmo">MMO</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="mmofps">MMO-FPS</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="mmorts">MMO-RTS</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="mmorpg">MMO-RPG</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="mmotps">MMO-TPS</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="military">Military</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="multiplayerOnlineBattleArena">Online Battle Arena</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="mmotps">MMO-TPS</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="military">Military</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="multiplayerOnlineBattleArena">Online Battle Arena</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="openWorld">Open World</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="permadeath">Permadeath</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="pixel">Pixel</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="pve">PVE</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="pvp">PVP</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="racing">Racing</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="sailing">Sailing</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="sandbox">Sandbox</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="sciFi">Sci-Fi</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="shooter">Shooter</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="sideScroller">Side Scroller</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="social">Social</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="space">Space</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="sports">Sports</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="strategy">Strategy</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="superhero">Superhero</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="survival">Survival</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="tank">Tank</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="thirdPerson">Third Person</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="topDown">Top Down</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="towerDefense">Tower Defense</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="turnBased">Turn Based</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="twoDimension">2D</a></h2>
    <h2 class="col shadow-sm pb-2"><a :href="voxel">Voxel</a></h2>
  </div>

  <div class="row mb-3">
    <h2 class="col shadow-sm pb-2"><a :href="zombie">Zombie</a></h2>
  </div>
</template>

<script>
export default {
  computed: {
    action() {
      return BASE_URL + '/category/action';
    },
    actionRolePlayingGame() {
      return BASE_URL + '/category/action-rpg';
    },
    anime() {
      return BASE_URL + '/category/anime';
    },
    battleRoyale() {
      return BASE_URL + '/category/battle-royale';
    },
    card() {
      return BASE_URL + '/category/card';
    },
    fighting() {
      return BASE_URL + '/category/fighting';
    },
    firstPerson() {
      return BASE_URL + '/category/first-person';
    },
    flight() {
      return BASE_URL + '/category/flight';
    },
    horror() {
      return BASE_URL + '/category/horror';
    },
    lowSpecs() {
      return BASE_URL + '/category/low-specs';
    },
    martialArts() {
      return BASE_URL + '/category/martial-arts';
    },
    mmo() {
      return BASE_URL + '/category/mmo';
    },
    mmofps() {
      return BASE_URL + '/category/mmofps';
    },
    mmorts() {
      return BASE_URL + '/category/mmorts';
    },
    mmorpg() {
      return BASE_URL + '/category/mmorpg';
    },
    mmotps() {
      return BASE_URL + '/category/mmotps';
    },
    military() {
      return BASE_URL + '/category/military';
    },
    multiplayerOnlineBattleArena() {
      return BASE_URL + '/category/multiplayer-online-battle-arena';
    },
    openWorld() {
      return BASE_URL + '/category/open-world';
    },
    permadeath() {
      return BASE_URL + '/category/permadeath';
    },
    pixel() {
      return BASE_URL + '/category/pixel';
    },
    pve() {
      return BASE_URL + '/category/pve';
    },
    pvp() {
      return BASE_URL + '/category/pvp';
    },
    racing() {
      return BASE_URL + '/category/racing';
    },
    sailing() {
      return BASE_URL + '/category/sailing';
    },
    sandbox() {
      return BASE_URL + '/category/sandbox';
    },
    sciFi() {
      return BASE_URL + '/category/sci-fi';
    },
    shooter() {
      return BASE_URL + '/category/shooter';
    },
    sideScroller() {
      return BASE_URL + '/category/side-scroller';
    },
    social() {
      return BASE_URL + '/category/social';
    },
    space() {
      return BASE_URL + '/category/space';
    },
    sports() {
      return BASE_URL + '/category/sports';
    },
    strategy() {
      return BASE_URL + '/category/strategy';
    },
    superhero() {
      return BASE_URL + '/category/superhero';
    },
    survival() {
      return BASE_URL + '/category/survival';
    },
    tank() {
      return BASE_URL + '/category/tank';
    },
    thirdPerson() {
      return BASE_URL + '/category/third-person';
    },
    topDown() {
      return BASE_URL + '/category/top-down';
    },
    towerDefense() {
      return BASE_URL + '/category/tower-defense';
    },
    turnBased() {
      return BASE_URL + '/category/turn-based';
    },
    twoDimension() {
      return BASE_URL + '/category/two-dimension';
    },
    voxel() {
      return BASE_URL + '/category/voxel';
    },
    zombie() {
      return BASE_URL + '/category/zombie';
    },
  },
}
</script>

<style scoped>

</style>