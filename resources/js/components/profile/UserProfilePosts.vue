<template>
    <div class="row pt-2">
        <user-profile-post v-for="post in images" :key="post.id" :post="post" />
    </div>
</template>

<script>

    export default {
        name: "UserProfilePosts",

        props: {
            posts: {
                type: Array,
                required: true
            },
        },

        computed: {

            images() {
                let images = []
                this.posts.forEach(post => {
                    images.push(...post.images)
                });
                return images;
            }

        }

    }
</script>

<style scoped>

</style>