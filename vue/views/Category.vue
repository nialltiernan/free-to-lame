<template>
  <div>
    <div class="row justify-content-between align-items-center pb-3 px-4">
      <h1>{{ renderTitle }}</h1>

      <div class="d-flex flex-row-reverse">
        <it-select placeholder="Sort by" v-model="sortByValue" :options="sortByOptions" @change="reloadData"/>
      </div>
    </div>
    <GameGrid :games="games"/>
  </div>
</template>

<script>
import GameGrid from '../components/GameGrid.vue';

export default {
  components: {GameGrid},
  props: {
    category: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      activeCategory: null,
      games: [],
      sortByValue: null,
      sortByOptions: [
        {
          'name': 'Alphabetical', 'value': 'alphabetical'
        },
        {
          'name': 'Popularity', 'value': 'popularity'
        },
        {
          'name': 'Release Date', 'value': 'release-date'
        },
        {
          'name': 'Relevance', 'value': 'relevance'
        },
      ],
    }
  },
  methods: {
    async fetchData(sortBy = 'popularity') {
      this.clearGames();

      const url = BASE_URL + '/category/' + this.activeCategory + '/json?sort-by=' + sortBy;

      let response = await fetch(url);

      if (!response.ok) {
        alert("HTTP-Error: " + response.status);
        return;
      }

      this.games = await response.json();
    },

    initActiveCategory() {
      this.activeCategory = this.category;
    },

    updateActiveCategory(category) {
      this.activeCategory = category;
    },

    clearGames() {
      this.games = [];
    },

    clearSortBy() {
      this.sortByValue = null;
    }
  },
  computed: {
    renderTitle() {
      if (this.category === 'action-rpg') {
        return 'Action Role Playing Game';
      } else if (this.category === 'low-specs') {
        return 'Low Specifications';
      } else if (this.category === 'mmo') {
        return 'Massively Multiplayer Online';
      } else if (this.category === 'mmofps') {
        return 'Massively Multiplayer Online First Person Shooter';
      } else if (this.category === 'mmorts') {
        return 'Massively Multiplayer Online Real Time Strategy';
      } else if (this.category === 'mmorpg') {
        return 'Massively Multiplayer Online Role Playing Game';
      } else if (this.category === 'mmotps') {
        return 'Massively Multiplayer Online Third Person Shooter';
      } else if (this.category === 'pve') {
        return 'Player Versus Environment';
      } else if (this.category === 'pvp') {
        return 'Player Versus Player';
      } else if (this.category === 'sci-fi') {
        return 'Science Fiction';
      }

      let words = this.category.split('-');

      words = words.map(function (word) {
        return word[0].toUpperCase() + word.substr(1);
      })

      return words.join(' ');
    },
    reloadData() {
      if (!this.sortByValue) {
        return;
      }
      this.fetchData(this.sortByValue.value)
    }
  },
  created() {
    this.initActiveCategory();

    this.fetchData();

    this.$watch(() => this.$route.params, (params) => {
      this.updateActiveCategory(params.category);
      this.clearSortBy();
      this.fetchData();
    });
  }
}
</script>

<style scoped>

</style>