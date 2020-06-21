<template>
    <div class="d-flex flex-column" v-if="post.replies.length">
        <div v-show="showViewAllLink" class="py-1">
            <a href="#">View all {{ post.replies.length }} replies</a>
        </div>
        <div class="py-2">
            <timeline-post-reply
                v-for="reply in displableReplies"
                :key="reply.id"
                :reply="reply"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "TimelinePostReplies",

        props: {
            post: {
                type: Object,
                required: true
            }
        },

        computed: {
            displableReplies() {
                return this.post.replies.slice(0, 2);
            },

            showViewAllLink() {
                return this.post.replies.length > 2;
            }
        }
    }
</script>

<style scoped>
    a {
        color: gray;
        text-decoration: none;
        font-weight: bold;
    }
</style>