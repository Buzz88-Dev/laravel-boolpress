<template>
    <div>
        <h1 class="text-center">Boolpress</h1>
        <div class="row g-2">
            <CardPost v-for="post in posts" :key="post.id" :post="post" />
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import CardPost from '../components/CardPost.vue';

export default {
    name : 'PageBlog',

    components: {
        CardPost,
    },

    data(){
        return {
            baseUrl: window.location.origin,
            posts: []
        }
    },

    created() {
        // qui facciamo la richiesta con axios di tipo get
        axios.get('/api/posts')    // o 'http://127.0.0.1:8000/api/posts'
            .then(res => {
                this.posts = res.data.response.data;   // me ne da 2 perche in PostController ho indicato: $per_page = $request->query('per_page', 2);
                console.log(this.posts);
                console.log(res); // andare in http://127.0.0.1:8000/ e guardare la console; l oggetto risposta è piu complesso rispetto a quello che ci serve; i dati sono in data, response, data
            })
            .catch(error => console.log('errore!!!'))
    },
}
</script>

<style lang="scss" scoped>
    @import 'bootstrap/scss/bootstrap';
</style>
