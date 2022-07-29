require('./bootstrap');

window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import App from './components/App.vue';

const app = new Vue({
    el: '#root',
    render: h => h(App),  // significato di render: in questa root monta il componente che si chiama App
});
