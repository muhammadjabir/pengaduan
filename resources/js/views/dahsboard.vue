<template>



     <v-app>
        <!-- <Progress v-if="loading"/> -->

        <v-container>
        <v-row v-if="loaded">
            <v-col
            cols="12"
            md="6"
            >
                 <v-card
                    class="border-edit"
                    tile
                    >
                    <v-btn small color="pink darken-2" class="white--text" tile>Pengaduan Korupsi</v-btn>
                        <v-card-text class="text-center">

                        <Bar-Chart :chartdata="data" :options="options" />

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

            </v-col>

            <v-col
            cols="12"
            md="6"
            >
                 <v-card
                    class="border-edit"
                    tile
                    >
                    <v-btn small color="green darken-2" class="white--text" tile>Pengaduan Masyarakat</v-btn>
                        <v-card-text class="text-center">

                        <Bar-Chart :chartdata="data2" :options="options" />

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

            </v-col>

            <v-col
            cols="12"
            md="6"
            >
                 <v-card
                    class="border-edit"
                    tile
                    >
                    <v-btn small color="orange darken-2" class="white--text" tile>E-Lapdu</v-btn>
                        <v-card-text class="text-center">

                        <Bar-Chart :chartdata="data3" :options="options" />

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

            </v-col>

            <v-col
            cols="12"
            md="6"
            >
                 <v-card
                    class="border-edit"
                    tile
                    >
                    <v-btn small color="red darken-2" class="white--text" tile>Gratifikasi Online</v-btn>
                        <v-card-text class="text-center">

                        <Bar-Chart :chartdata="data4" :options="options" />

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

            </v-col>

            <v-col
            cols="12"
            md="6"
            >
                 <v-card
                    class="border-edit"
                    tile
                    >
                    <v-btn small color="blue darken-2" class="white--text" tile>Wistle Blowing System (WBS)</v-btn>
                        <v-card-text class="text-center">

                        <Bar-Chart :chartdata="data5" :options="options" />

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

            </v-col>
        </v-row>


        </v-container>
    </v-app>
</template>

<script>
import BarChart from '../components/chart/Bar'
export default {
    components:{
    'Bar-Chart':BarChart,
  },
  data() {
      return {
          data:null,
          data2:null,
          data3: null,
          data4:null,
          data5:null,
          options: {
            responsive: true,
            scales: {
                    yAxes:[{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
            }
          },
          loaded: false,
          labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      }
  },
  async created () {
        let url = '/dashboard'
        await this.axios.get(url)
        .then((ress) =>{
            console.log(ress)
            this.data = {
            labels:this.labels,
            datasets: [
              {
                label: 'Pengaduan Korupsi ' + ress.data.tahun,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor:['rgba(255, 99, 132, 0.1)'],
                data: [ress.data.pengaduan_korupsi]
              }
            ]
          }
          this.data2 = {
            labels: this.labels,
            datasets: [
              {
                label: 'Pengaduan Masyarakat ' + ress.data.tahun,
                backgroundColor: "rgba(0, 153, 0, 0.2)",

                borderColor:['rgba(255, 99, 132, 0.1)'],
                data: ress.data.pengaduan_masyarakat
              }
            ]
          }

          this.data3 = {
            labels: this.labels,
            datasets: [
              {
                label: 'E-Lapdu ' + ress.data.tahun,
                backgroundColor: "rgba(255, 128, 0, 0.2)",

                borderColor:['rgba(255, 99, 132, 0.1)'],
                data: ress.data.elapdu
              }
            ]
          }

          this.data4 = {
            labels: this.labels,
            datasets: [
              {
                label: 'Gratifikasi Online ' + ress.data.tahun,
                backgroundColor: "rgba(204, 0, 0, 0.2)",

                borderColor:['rgba(255, 99, 132, 0.1)'],
                data: ress.data.gratifikasi
              }
            ]
          }

          this.data5 = {
            labels: this.labels,
            datasets: [
              {
                label: 'Wistle Blowing System (WBS) ' + ress.data.tahun,
                backgroundColor: "rgba(0, 102, 204, 0.2)",

                borderColor:['rgba(255, 99, 132, 0.1)'],
                data: ress.data.wbs
              }
            ]
          }


        })
        .catch((err) => {
            console.log(err.response)
        })

        this.loaded = true

  }
}
</script>

<style>

</style>
