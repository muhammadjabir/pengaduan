import { Bar } from 'vue-chartjs'
export default {
  data(){
    return{

    }
  },
  props: {
    chartdata: {
      type: Object,
      default: null
    },
    options:{
      type: Object,
      default: null
    }
  },
  extends: Bar,
  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
