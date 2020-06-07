<template>
  <div>
    <div class="card">
      <div class="card-header">New game</div>

      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Your name</label>
            <input type="text" class="form-control" v-bind:class="nameFieldError" id="exampleInputEmail1" v-model="name">
            <div v-if="errors.name" class="invalid-feedback">
              Some errors ocurred:
              <ul>
                <li v-for="error in errors.name">{{ error }}</li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hand</label>
            <input type="text" class="form-control" v-bind:class="handFieldError" id="exampleInputPassword1" v-model="handBuilded">
            <div v-if="errors.hand" class="invalid-feedback">
              Some errors ocurred:
              <ul>
                <li v-for="error in errors.hand">{{ error }}</li>
              </ul>
            </div>
            <small class="form-text text-muted">Only these cards are allowed: 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A</small>
          </div>
          <button @click="play" type="button" class="btn btn-primary">Play!</button>
        </form>
      </div>
    </div>

    <div v-if="result" class="alert alert-dismissible fade show" v-bind:class="alertMatchResult">
      <h4 class="alert-heading">Match result:</h4>
      <ul>
        <li>Your score: {{ result.scores.user }}</li>
        <li>Opponent score: {{ result.scores.opponent }}</li>
      </ul>
      <hr>
      <p class="mb-0" v-if="result.userWin === true">You <strong>won</strong> this match!</p>
      <p class="mb-0" v-else>You <strong>lost</strong> this match.</p>

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
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
    }),
    methods: {
      play: async function(e) {
        e.preventDefault();

        const data = {
          name: this.name,
          hand: this.hand,
        };

        await api.post('play', data)
          .then(response => {
            this.result = response.data;
            this.hand = [];
            this.errors = [];
          })
          .catch(error => {
            const { errors } = error.response.data;

            this.errors = errors;
          });
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
        return {
          'is-invalid': this.errors.name && this.errors.name.length > 0,
        }
      },
      handFieldError: function() {
        return {
          'is-invalid': this.errors.hand && this.errors.hand.length > 0,
        }
      },
      alertMatchResult: function() {
        return {
          'alert-danger': this.result.userWin === false,
          'alert-success': this.result.userWin === true
        }
      }
    }
  }
</script>
