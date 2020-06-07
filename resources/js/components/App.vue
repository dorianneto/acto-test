<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <game></game>
      </div>
      <div class="col-md-8">
        <Leadboard></Leadboard>
      </div>
    </div>
  </div>
</template>

<script>
  import Game from './Game';
  import Leadboard from './Leadboard';

  export default {
    components: {
      Game,
      Leadboard
    }
  }
</script>
