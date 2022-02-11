window.axios = require('axios');
window.Vue = require('vue');

import App from './App.vue';
//4  importo la classe router, avendo fatto l'export default e averla resa disponibile
import router from './routes';


const app = new Vue({
    el: '#app',
    //4  a questo punto inietto la classe router dentro vue router: router
    router,
    render: h => h(App)
});
