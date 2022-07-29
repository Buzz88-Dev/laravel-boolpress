require('./bootstrap');

// window.Vue = require('vue'); importiamo la libreria Vue
import Vue from 'vue';   // questocodice è uguale a window.Vue = require('vue'); importiamo la libreria Vue
import VueRouter from 'vue-router';  // importiamo la libreria vue-router
import App from './App.vue'; // importiamo il componente base App.vue e lo assegniamo alal variabile App

// importiamo tutti i componenti delle pagine
import PageHome from './pages/PageHome.vue';
import PageBlog from './pages/PageBlog.vue';
import PageAbout from './pages/PageAbout.vue';
import PageContacts from './pages/PageContacts.vue';
import PageShow from './pages/PageShow.vue';


const routes = [
    {
        // rotta 1; qui mettiamo 9 post random
        path: '/',    // ('/'
        name: 'home',   // name('home');
        component: PageHome,  // return view('guests.home');

        // Route::get('/', function () {
        //     return view('guests.home');
        // })->name('home');
    },

    {
        // rotta 2; questa è la index (paginata) dei post
        path: '/blog',
        name: 'blog',
        component: PageBlog,
    },

    {
        // rotta 3;
        path: '/about',
        name: 'about',
        component: PageAbout,
    },

    {
        // rotta 4;
        path: '/contacts',
        name: 'contacts',
        component: PageContacts,
    },

    {
        // rotta 5:  questa è la pagina di dettaglio di un post
        path: '/blog/:slug',
        name: 'show',
        component: PageShow,
        props: true,   // analizzare documentazione Vue Router
    },

]

const router = new VueRouter({
    routes
})

Vue.use(VueRouter)   // dentro alla parentesi ci vuole il nome indicato in riga 5; diciamo a Vue di usare il plugin vue-router

const app = new Vue({
    el: '#root',          // id del componente nel file HTML dentro il quale operera Vue
    render: h => h(App),  // significato di render: in questa root monta il componente che si chiama App
    router,  // diciamo a Vue di inizializzare la nostra app usando il router
});
