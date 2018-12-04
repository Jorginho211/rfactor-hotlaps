<template>
  <div id="app">
    <Loading :active="this.isLoading" />
    <div class="trackOptions">
      <TrackOptions :tracks="this.tracks" @change-track="this.changeTrack" @change-times-107="this.changeIsCheckedTime107"/>
    </div>
    <div class="table">
      <Table :track="this.selectedTrack" :isCheckedTimes107="this.isCheckedTime107" />
    </div>
  </div>
</template>

<script>
import Loading from './components/Loading.vue'
import TrackOptions from './components/TrackOptions.vue'
import Table from './components/Table.vue'

export default {
  name: 'rfactor-hotlaps',
  components: {
    Loading,
    TrackOptions,
    Table
  },
  data () {
    return {
      tracks: [],
      selectedTrack: {},
      isCheckedTime107: false,
      isLoading: false
    }
  },
  props: {
    src: String
  },
  created(){
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.isLoading = true;
      
      let url =  '/wp-admin/admin-ajax.php?action=get_hotlaps_json&src=' + this.src;
      var ctx = this;
      
      fetch(url, {
        method: 'GET',
        headers:{
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then((data) => {
        ctx.parseTracks(data);
        ctx.isLoading = false;
      });

      
      // setTimeout((() => {
      //   let data = JSON.parse('[{"category":"Unknown","tracks":[{"name":"Circuito Termas de Rio Hondo","drivers":[{"name":"RaFael Bejarano","session":"Qualifying","pos":1,"lapCount":98,"lapTime":100.043},{"name":"Martin Segado","session":"Race","pos":2,"lapCount":37,"lapTime":100.101},{"name":"Juan Antonio Plaza","session":"Practice","pos":3,"lapCount":33,"lapTime":100.777},{"name":"Adrian Carmona","session":"Practice","pos":4,"lapCount":197,"lapTime":100.899},{"name":"Luis Daniel Pons Campos","session":"Qualifying","pos":5,"lapCount":45,"lapTime":101.177},{"name":"Eduardo Vaamonde","session":"Race","pos":6,"lapCount":30,"lapTime":101.69},{"name":"DaNyPoNs8","session":"Practice","pos":7,"lapCount":15,"lapTime":101.841},{"name":"Victor Garcia","session":"Race","pos":8,"lapCount":46,"lapTime":101.882},{"name":"Kike Contreras","session":"Qualifying","pos":9,"lapCount":126,"lapTime":101.888},{"name":"Santiago Garcia","session":"Qualifying","pos":10,"lapCount":74,"lapTime":101.888},{"name":"Ramon Macias","session":"Race","pos":11,"lapCount":22,"lapTime":102.093},{"name":"Esteban Tolosa","session":"Qualifying","pos":12,"lapCount":37,"lapTime":102.113},{"name":"Ibriam Ariztimu\u00a4o","session":"Practice","pos":13,"lapCount":192,"lapTime":102.301},{"name":"Pablo Matta","session":"Race","pos":14,"lapCount":33,"lapTime":102.569},{"name":"IVAN GARCIA","session":"Race","pos":15,"lapCount":35,"lapTime":102.809},{"name":"Ruben Torres","session":"Qualifying","pos":16,"lapCount":33,"lapTime":103.223}]},{"name":"Okayama International Circuit","drivers":[{"name":"RaFa2045","session":"Practice","pos":1,"lapCount":85,"lapTime":87.414},{"name":"Alvaro Ruiz","session":"Practice","pos":2,"lapCount":118,"lapTime":87.694},{"name":"Martin Segado","session":"Practice","pos":3,"lapCount":147,"lapTime":87.774},{"name":"emilio garcia","session":"Practice","pos":4,"lapCount":51,"lapTime":88.298},{"name":"Adrian Carmona","session":"Practice","pos":5,"lapCount":116,"lapTime":88.303},{"name":"Daniel Felipe","session":"Practice","pos":6,"lapCount":54,"lapTime":88.587},{"name":"Esteban Tolosa","session":"Practice","pos":7,"lapCount":94,"lapTime":88.614},{"name":"Ibriam Ariztimu\u00a4o","session":"Practice","pos":8,"lapCount":586,"lapTime":88.83},{"name":"DaNyPoNs8","session":"Practice","pos":9,"lapCount":23,"lapTime":88.846},{"name":"Eduardo Vaamonde","session":"Practice","pos":10,"lapCount":121,"lapTime":88.925},{"name":"Maverick","session":"Practice","pos":11,"lapCount":61,"lapTime":89.136},{"name":"Kike Contreras","session":"Practice","pos":12,"lapCount":260,"lapTime":89.137},{"name":"Samuel Carre\u00a4o","session":"Practice","pos":13,"lapCount":169,"lapTime":89.452},{"name":"PRUEBAS TV","session":"Practice","pos":14,"lapCount":52,"lapTime":89.898},{"name":"Ruben Torres","session":"Practice","pos":15,"lapCount":85,"lapTime":90.116},{"name":"Jose Enrique","session":"Practice","pos":16,"lapCount":62,"lapTime":90.648},{"name":"Pepitogrillo","session":"Practice","pos":17,"lapCount":3,"lapTime":97.199}]}]}]');
      //   this.parseTracks(data);
      //   this.isLoading = false;
      // }).bind(this), 2000);
    },
    changeTrack(index){
      this.selectedTrack = this.tracks[index];
    },
    changeIsCheckedTime107(checked){
      this.isCheckedTime107 = checked;
    },
    parseTracks(data){
      let tracks = [];
      for(let i = 0; i < data.length; i++){
        for(let j = 0; j < data[i].tracks.length; j++){
          tracks.push({
            ...data[i].tracks[j],
          });
        }
      }

      this.tracks = tracks;
      this.selectedTrack = this.tracks.length > 0 ? this.tracks[0] : [];
    }
  }
}
</script>

<style>
  .table {
    margin-top: 10px;
  }
</style>
