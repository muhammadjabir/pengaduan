import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './stores'
import './plugins/axios.js'
import vuetify from './plugins/vuetify'
import CKEditor from '@ckeditor/ckeditor5-vue';


Vue.use( CKEditor );
// import CKEditor from '@ckeditor/ckeditor5-vue';
// ck editor


// Vue.use( CKEditor );

new Vue({
  router,
  vuetify,
   store,
  render: h => h(App)
}).$mount('#app')
