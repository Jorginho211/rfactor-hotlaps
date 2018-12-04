<template>
  <div id="trackOptions">
    <div>
      <label>Circuito: 
        <select @change="this.changeTrack">
          <option v-for="(track, index) in this.tracks" :key="index" :value="index">{{track.name}}</option>
        </select>
      </label>
    </div>
    <div>
      <label>
        <input type=checkbox @change="this.changeTimes107"> Tiempos dentro del 107%
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TrackOptions',
  props: {
    tracks: Array
  },
  methods: {
    changeTrack(event) {
      let index = Number(event.target.value)
      this.$emit('change-track', index);
    },
    changeTimes107(event){
      this.$emit('change-times-107', event.target.checked);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  #trackOptions {
    display: flex;
    text-align: center;
    align-items: center;
  }

  #trackOptions > div {
    flex: 1;
  }
</style>
