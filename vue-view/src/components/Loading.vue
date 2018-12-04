<template>
  <div v-if="this.active" id="loading">
      <div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'Loading',
  props: {
    active: Boolean
  },
  methods: {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    #loading {
        position: absolute;
    }

    #loading div {
        width: 25px;
        height: 25px;
        border: 5px solid #ddd;
        border-top-color: #00cbff;
        border-radius: 50%;
        animation: loading-animation 2s linear infinite;
    }

    @keyframes loading-animation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
