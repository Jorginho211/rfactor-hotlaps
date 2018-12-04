<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>Pos</th>
          <th>Nombre</th>
          <th>Tiempo</th>
          <th>Vueltas</th>
          <th>Sesión</th>
        </tr>
      </thead>
      <tbody>
        <tr :class="timeIn107(driver.lapTime)" v-for="(driver, index) in track.drivers" :key="index">
          <td>{{driver.pos}}</td>
          <td>{{driver.name}}</td>
          <td>{{ formatTime(driver.lapTime) }}</td>
          <td>{{driver.lapCount}}</td>
          <td>{{driver.session}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'Table',
  props: {
    track: Object,
    isCheckedTimes107: Boolean
  },
  data() {
    return {
      bestTime: -1
    }
  },
  beforeUpdate () {
    if(this.isCheckedTimes107 && typeof this.track.drivers !== "undefined" && this.track.drivers.length > 0){
      let bestTime = this.track.drivers[0].lapTime * 1.07;
      if(this.bestTime !== bestTime){
        this.bestTime = bestTime;
      }
    }
  },
  methods: {
    formatTime(time) {
      let minutes = this.timeToMinutes(time);
      let seconds = this.timeToSeconds(time);
      let miliseconds = this.timeToMiliSeconds(time);

      miliseconds = miliseconds.toString();
      for(let i = miliseconds.length - 1; i < 2; i++){
        miliseconds = "0" + miliseconds;
      }

      if(seconds < 10){
        seconds = "0" + seconds;
      }

      return minutes + ":" + seconds + "." + miliseconds;
    },
    timeToMinutes(time){
      return Math.floor(time/60);
    },
    timeToSeconds(time){
      return Math.floor(time - (this.timeToMinutes(time) * 60));
    },
    timeToMiliSeconds(time){
      return Math.floor((time - Math.floor(time)) * 1000);
    },
    timeIn107(time){
      if(this.isCheckedTimes107 && this.bestTime > -1 && time < this.bestTime){
        return 'hightlight';
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  table td, table th {
    border: 1px solid #EAEAEA;
    padding: 8px;
  }

  table tr:nth-child(even){background-color: #f2f2f2;}

  table tr:hover {background-color: #ddd!important;}

  table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #00cbff;
      color: white;
  }

  .hightlight {
    background-color: yellow!important;
  }
</style>
