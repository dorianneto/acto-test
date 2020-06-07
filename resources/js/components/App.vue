<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <game></game>
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
