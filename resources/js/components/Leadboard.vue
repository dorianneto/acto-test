<template>
  <div class="card">
    <div class="card-header">Leadboard</div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <caption>Last update at {{ updatedAtFormatted }}</caption>
          <thead>
            <tr>
              <th width="15%">Rank</th>
              <th>Name</th>
              <th>Matches</th>
              <th>Wins</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in data" :key="index">
              <td><span class="badge badge-pill" v-bind:class="rankBadge(index)">{{ index+1 }}</span></td>
              <td>{{ item.name }}</td>
              <td>{{ item.total_matches }}</td>
              <td>{{ item.total_wins }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import api from '../services/api.js';

  export default {
    data: () => ({
      data: [],
      updatedAt: new Date()
    }),
    mounted: async function () {
      await api.get('leadboard')
        .then(response => {
          this.data = response.data;
        })
        .catch(error => {
          alert(error);
        });
    },
    methods: {
      rankBadge: function(rank) {
        if (rank > 2) {
          return { 'badge-light': true }
        }

        if (rank === 0) {
          return { 'badge-gold': true }
        }

        if (rank === 1) {
          return { 'badge-silver': true }
        }

        if (rank === 2) {
          return { 'badge-bronze': true }
        }
      }
    },
    computed: {
      updatedAtFormatted: function() {
        const options = {
          year: 'numeric', month: 'numeric', day: 'numeric',
          hour: 'numeric', minute: 'numeric', second: 'numeric',
          hour12: true,
          timeZone: 'America/Toronto'
        }

        return new Intl.DateTimeFormat('en-CA', options).format(this.updatedAt);
      }
    }
  }
</script>


<style lang="scss">
  .badge {
    &.badge-gold {
      background-color: #D6AF36;
    }
    &.badge-silver {
      background-color: #A7A7AD;
    }
    &.badge-bronze {
      background-color: #A77044;
      color: #fff;
    }
  }
</style>
