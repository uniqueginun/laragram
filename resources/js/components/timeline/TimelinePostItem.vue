<template>
    <div class="card mb-5">
        <div class="card-body">
            <user-card :user="post.user" />
            <div class="py-3">
                <carousel :pagination-enabled="true" :navigation-enabled="true" :perPage="1" v-if="post.images" class="h-100">
                    <slide class="h-100" v-for="image in post.images" :key="image.path">
                        <div class="d-flex flex-row h-100">
                            <div class="w-100">
                                <img class="rounded" :src="image.path" width="100%"  height="100%" />
                            </div>
                        </div>
                    </slide>
                </carousel>
            </div>
            <div class="w-25 d-flex justify-content-between">
                <post-action-like :post="post" @clicked="toggleLike()" />
                <post-action-reply @focusReply="focusReply" :post="post" />
                <a href="#">
                    <svg class="bi bi-cursor" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
                    </svg>
                </a>
            </div>
            <div v-if="post.likes" class="pt-3">
                <span class="font-weight-bold">{{ post.likes }} Likes</span>
            </div>
            <div class="py-3">
                <timeline-post-replies :post="post" />
            </div>
            <timeline-post-compose-reply ref="commentField" :post="post" />
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "TimelinePostItem",

        props: {
            post: {
                type: Object,
                required: true
            }
        },

        methods: {
            focusReply() {
                this.$refs.commentField.$el.firstChild.focus()
            },
            async toggleLike() {
                await this.$store.dispatch('timeline/toggleLike', this.post);
            }
        },

        computed: {
            ...mapGetters({
                user_likes: 'timeline/user_likes'
            }),

            isLiked() {
                return this.user_likes.includes(this.post.id)
            }
        }
    }
</script>

<style scoped>

</style>