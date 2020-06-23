<template>
    <div class="pb-2">
        <user-card :user="reply.user">
            <div class="d-flex flex-column">
                {{ reply.body }}
                <div class="mt-2" v-if="reply.sub_replies.length">
                    <a @click.prevent="showSubReplies = !showSubReplies" href="#">
                        {{ subRepliesLinkText }}
                    </a>
                    <div class="pt-2" v-if="showSubReplies">
                        <timeline-post-reply
                           v-for="item in reply.sub_replies"
                           :key="reply.id"
                           :reply="item"
                        />
                    </div>
                </div>
            </div>
        </user-card>
    </div>
</template>

<script>
    export default {
        name: "TimelinePostReply",

        data: () => {
            return {
                showSubReplies: false
            }
        },

        props: {
            reply: {
                required: true,
                type: Object
            }
        },

        computed: {
            subRepliesLinkText() {
                return this.showSubReplies ? 'Hide Replies' : 'View Replies';
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