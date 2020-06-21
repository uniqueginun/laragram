<template>
    <div>
        <user-profile-info v-if="user"
            :user="user"
            :posts="posts"
            :followers="followers"
            :following="following"
            :followedByMe="followedByMe"
        />
        <div v-if="posts">
            <user-profile-posts
                    :posts="posts"
            />
            <div v-observe-visibility="visibilityChanged"></div>
        </div>
        <div v-else>
            <h3>They havn't posted anything yet!</h3>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapGetters } from 'vuex'

    export default {

        name: "UserProfile",

        data: () => {
            return {
                page: 1,
                last_page: 1
            }
        },

        props: {
            user: {
                type: Object,
                required: true
            },

            followedByMe: {
                required: true
            }
        },

        methods: {
            ...mapActions({
                fetchUserData: 'profile/fetchUserData',
                fetchPosts: 'profile/fetchPosts'
            }),

            visibilityChanged (isVisible, entry) {
                if(isVisible) {
                    if (this.page <= this.last_page) {
                        this.fetchPosts(`/api/user/${this.user.username}/posts?page=${this.page}`).then(response => {
                            this.last_page = response.meta.last_page;
                            this.page++;
                        })
                    }
                }
            }
        },

        computed: {
            ...mapGetters({
                posts: 'profile/posts',
                followers: 'profile/followers',
                following: 'profile/following',
            }),
        },

        mounted() {
            this.fetchUserData(this.user).then(res => {

            })
        }

    }

</script>

<style scoped>

</style>