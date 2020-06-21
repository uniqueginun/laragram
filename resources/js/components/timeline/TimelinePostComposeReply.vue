<template>
    <div>
        <input type="text" v-model="reply" @keyup="handleKeyDown" class="form-control" placeholder="Add a comment..." />
    </div>
</template>

<script>

    export default {
        name: "TimelinePostComposeReply",

        props: {
            post: {
                type: Object,
                required: true
            }
        },

        data: () => {
            return {
                reply: ''
            }
        },

        methods: {
            async handleKeyDown(e) {
                if(e.key !== "Enter" || !this.reply) {
                    return
                }

                await this.$store.dispatch('timeline/replyToPost', {
                    id: this.post.id,
                    body: this.reply
                });

                this.reply = ''
            }
        }
    }
</script>

<style scoped>

</style>