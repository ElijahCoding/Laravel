<template>
    <div>
        <app-timeline-create></app-timeline-create>

        <div class="timeline__posts">
            <app-timeline-post
                v-for="post in posts"
                :post="post"
                :key="post.id"
                />
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapActions, mapGetters } from 'vuex'

    export default {
        methods: {
            ...mapActions({
                getPosts: 'getPosts'
            })
        },

        computed: {
            ...mapGetters({
                posts: 'posts'
            })
        },

        mounted () {
            this.getPosts()
        }
    }
</script>

<style>
    .timeline__posts {
        margin-top: 40px;
    }
</style>
