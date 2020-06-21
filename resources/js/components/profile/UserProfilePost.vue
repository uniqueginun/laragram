<template>
    <div class="col-md-4 mb-2 post-item">
        <a href="#" @click.prevent="loadPostInfo">
            <img :src="post.path" class="w-100"  />
        </a>
    </div>
</template>

<script>
    import UserProfilePostDetail from "./UserProfilePostDetail";

    export default {
        name: "UserProfilePost",

        props: {
            post: {
                type: Object,
                required: true
            }
        },

        methods: {
            loadPostInfo() {
                this.$modal.show(UserProfilePostDetail, {
                    post: this.post
                }, {
                    width: "60%",
                    height: "80%"
                });
            }
        }

    }
</script>

<style scoped>
    .post-item {
        padding-left: 0;
        padding-right: 0;
    }
</style>