<template>
  <div>
    <div class="card">
      <div class="card-header">New game</div>

      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Your name</label>
            <input type="text" class="form-control" v-bind:class="nameFieldError" id="exampleInputEmail1" v-model.trim="name">
            <div v-if="errors.name" class="invalid-feedback">
              Some errors ocurred:
              <ul>
                <li v-for="error in errors.name">{{ error }}</li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hand</label>
            <input type="text" class="form-control text-uppercase" v-bind:class="handFieldError" id="exampleInputPassword1" v-model.trim="handBuilded">
            <div v-if="errors.hand" class="invalid-feedback">
              Some errors ocurred:
              <ul>
                <li v-for="error in errors.hand">{{ error }}</li>
              </ul>
            </div>
            <small class="form-text text-muted">Cards allowed: 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A</small>
          </div>
          <button @click="play" type="button" class="btn btn-primary">Play!</button>
        </form>
      </div>
    </div>

    <div v-if="showAlert" id="match-result-alert" class="alert alert-dismissible fade show mt-3" v-bind:class="alertMatchResult">
      <h4 class="alert-heading">Match result:</h4>
      <ul>
        <li>Your score: {{ result.scores.user }}</li>
        <li>Opponent score: {{ result.scores.opponent }}</li>
      </ul>
      <hr>
      <p class="mb-0" v-if="result.userWin === true">You <strong>won</strong> this match!</p>
      <p class="mb-0" v-else>You <strong>lost</strong> this match.</p>

      <button type="button" class="close" @click="closeAlert">
        <span>&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
  import api from '../services/api.js';

  export default {
    data: () => ({
      name: null,
      hand: [],
      errors: [],
      result: null,
      showAlert: false
    }),
    methods: {
      play: async function(e) {
        e.preventDefault();

        const { name, hand } = this;

        const data = {
          name,
          hand: hand.map(card => card.toUpperCase())
        };

        await api.post('play', data)
          .then(response => {
            const { data } = response;

            this.result = data;
            this.hand = [];
            this.errors = [];
            this.showAlert = true;

            this.$emit('update-leadboard', true);
          })
          .catch(error => {
            const { errors } = error.response.data;

            this.errors = errors;
          });
      },
      closeAlert: function() {
        this.showAlert = false;
      }
    },
    computed: {
      handBuilded: {
        get: function() {
          return this.hand.join(' ');
        },
        set: function(value) {
          this.hand = value.split(' ');
        }
      },
      nameFieldError: function() {
        const { name } = this.errors;

        return {
          'is-invalid': name && name.length > 0,
        }
      },
      handFieldError: function() {
        const { hand } = this.errors;

        return {
          'is-invalid': hand && hand.length > 0,
        }
      },
      alertMatchResult: function() {
        const { userWin } = this.result;

        return {
          'alert-danger': userWin === false,
          'alert-success': userWin === true
        }
      }
    }
  }
</script>
