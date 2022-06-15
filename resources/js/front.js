window.Vue = require('vue');
import App from './components/app.vue';
const root = new Vue({
    el:'#root',
    render: h => h(App)
})