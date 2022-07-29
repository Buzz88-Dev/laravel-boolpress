require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';   // questocodice è uguale a window.Vue = require('vue');
import VueRouter from 'vue-router';
import App from './components/App.vue';

Vue.use(VueRouter)   // dentro alla parentesi ci vuole il nome indicato in riga 5

const app = new Vue({
    el: '#root',          // id del componente nel file HTML dentro il quale operera Vue
    render: h => h(App),  // significato di render: in questa root monta il componente che si chiama App
});
