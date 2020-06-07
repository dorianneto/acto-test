<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <game v-on:update-leadboard="onUpdateLeadboard"></game>
      </div>
      <div class="col-md-8">
        <leadboard :key="componentKey"></leadboard>
      </div>
    </div>
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
