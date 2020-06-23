<template>
    <carousel :pagination-enabled="true" :perPage="1" v-if="postInfo" class="h-100">
        <slide class="h-100" v-for="image in images" :key="image.path">
            <div class="d-flex flex-row h-100">
                <div class="w-50">
                    <img :src="image.path" width="450"  height="100%" />
                </div>
                <div class="d-flex flex-column w-100">
                    <div class="w-100 border-bottom p-3">
                        <user-card :user="postInfo.user" />
                    </div>
                    <div class="w-100 border-bottom p-3">
                        <user-card :user="postInfo.user">
                            <p class="font-weight-light">{{ postInfo.caption }}</p>
                        </user-card>
                    </div>
                    <div class="h-100 p-3">
                        <div class="h-auto">
                            <post-replies :post="postInfo" />
                        </div>
                        <div>
                            <post-actions :post="post" />
                        </div>
                    </div>

                    <timeline-post-compose-reply ref="commentField" :post="postForReply" />
                </div>
            </div>
        </slide>
    </carousel>
</template>

<script>
    export default {

        name: "UserProfilePostDetail",

        data: () => {
            return {
                postInfo: null,
                images: []
            }
        },

        props: {
            post: {
                required: true,
                type: Object
            }
        },

        methods: {
            async fetchPostDetails() {
                const { data } = await axios.get(`/api/posts/${this.post.post_id}`)
                this.postInfo = (data.data)
                this.images.push(...data.data.images.filter(i => i.path !== this.post.path))
            }
        },

        mounted() {
            this.images.push(this.post)
            this.fetchPostDetails()
        },

        computed: {
            postForReply() {
                return {
                    id: this.post.post_id,
                    path: this.post.path
                }
            }
        }

    }
</script>

<style scoped>

</style>