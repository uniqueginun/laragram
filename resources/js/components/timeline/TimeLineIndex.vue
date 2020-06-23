<template>
    <div>
        <div v-if="posts">
            <timeline-post-item
                v-for="post in posts"
                :key="post.id"
                :post="post"
            />
            <div v-observe-visibility="visibilityChanged"></div>
        </div>
        <div v-else>
            <h4>the timeline is currently empty</h4>
        </div>
    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

    export default {

        name: "TimeLineIndex",

        data: () => {
            return {
                page: 1,
                lastPage: 1
            }
        },

        computed: {
            url() {
                return `/api/timeline?page=${this.page}`
            },
            ...mapGetters({
                posts: 'timeline/posts'
            }),

            channelName() {
                return 'timeline.' + this.$user.id;
            }
        },

        methods: {
            fetchPosts() {
                if (this.page <= this.lastPage) {
                    this.$store.dispatch('timeline/grabPosts', this.url)
                        .then(data => {
                            this.lastPage = data.meta.last_page
                            this.page++
                        })
                }
            },
            visibilityChanged (isVisible) {
                if(isVisible) {
                    this.fetchPosts()
                }
            },
            listenForTimelineChannelEvents() {
                Echo.private(this.channelName)
                    .listen('.post.created', e => {

                        this.$store.commit('timeline/PUSH_POSTS', [e])
                        this.$toasted.success(`${e.user.name} created new post`)
                    });
            }
        },

        mounted() {
            this.listenForTimelineChannelEvents();
        }
    }
</script>

<style scoped>

</style>