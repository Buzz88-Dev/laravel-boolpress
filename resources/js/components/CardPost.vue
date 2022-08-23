<template>
    <div class="col-sm-6 col-md-4">
        <div class="card h-100">
            <img :src="post.image" class="card-img-top" :alt="post.title">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text mb-auto pb-3">{{ post.excerpt }}</p>
                <router-link :to="{name: 'show', params: {slug: post.slug} }" class="btn btn-primary">Read</router-link>
                <!-- in front.js path: '/blog/:post', -->
                <!-- guardare collegamento a file front.js indicato sotto -->
                <!-- {
                    // rotta 5:  questa è la pagina di dettaglio di un post
                    path: '/blog/:slug',
                    name: 'show',
                    component: PageShow,
                    props: true,   // analizzare documentazione Vue Router
                }, -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardPost',
    props: {
        post: Object,
    }
}
</script>

<style lang="scss" scoped>
</style>
