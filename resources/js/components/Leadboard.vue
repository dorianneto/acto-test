<template>
  <div class="card">
    <div class="card-header">Leadboard</div>

    <div class="card-body">
      <div class="table-responsive" v-if="showTable">
        <p v-if="loading">Loading...</p>
        <table class="table" v-else>
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
      <p v-else>There isn't data enough to build a leaderboard yet.</p>
    </div>
  </div>
</template>

<script>
  import api from '../services/api.js';

  export default {
    data: () => ({
      data: [],
      updatedAt: new Date(),
      loading: false,
      showTable: true,
    }),
    mounted: function () {
      this.loadLeadboard();
    },
    methods: {
      loadLeadboard: async function() {
        this.loading = true;

        await api.get('leadboard')
          .then(response => {
            this.data = response.data;
            this.loading = false;

            if (response.data.length === 0) {
              this.showTable = false;
            }
          })
          .catch(error => {
            alert(error);
          });
      },
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
