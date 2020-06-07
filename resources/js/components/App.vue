<template>
  <div id="application">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4">
            <game v-on:update-leadboard="onUpdateLeadboard"></game>
          </div>
          <div class="col-12 col-md-8">
            <leadboard :key="componentKey"></leadboard>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <p>Built with ♥ by <a href="https://dorianneto.com.br/" target="_blank">Dorian Neto</a></p>
    </footer>
  </div>
</template>

<script>
  import Game from './Game';
  import Leadboard from './Leadboard';

  export default {
    data: () => ({
      componentKey: 0,
    }),
    components: {
      Game,
      Leadboard
    },
    methods: {
      onUpdateLeadboard: function(value) {
        this.componentKey += 1;
      }
    }
  }
</script>

<stylel lang="scss">
  #application {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 100vh;

    main {
      .container {
        .row {
          & > div {
            margin: 20px 0;
          }
        }
      }
    }

    footer {
      text-align: center;
    }
  }
</stylel>
