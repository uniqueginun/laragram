<template>
    <div class="row justify-content-center border-bottom pb-5">
        <div class="col-md-10 md-offset-2 d-flex flex-row align-items-center justify-content-start">
            <div>
                <img class="profile-image rounded-circle" :src="user.profile.avatar" />
            </div>
            <div class="ml-lg-5 pl-lg-5 w-50 d-flex flex-column justify-content-md-around h-100">
                <div class=" d-flex justify-content-between align-items-center mb-3">
                    <h2 class="username">{{ user.username }}</h2>
                    <profile-following v-if="showFollowingButton" :followedByMe="followedByMe" :user="user" />
                    <a v-if="$user.id == user.id" href="/profiles/edit" class="btn btn-sm btn-secondary">Edit Profile</a>
                </div>
                <div>
                    <ul>
                        <li>
                            <span class="font-weight-bold">{{ postsCount }}</span> posts
                        </li>
                        <li>
                            <span class="font-weight-bold">{{ followersCount }}</span> followers
                        </li>
                        <li>
                            <span class="font-weight-bold">{{ followingCount }}</span> following
                        </li>
                    </ul>
                </div>
                <div>
                    <p v-html="user.profile.bio"></p>
                    <p><a :href="user.profile.url">{{ user.profile.url }}</a></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "UserProfileInfo",

        props: {
            user: {
                type: Object,
                required: true
            },
            followers: {
                type: Array,
                required: true
            },
            following: {
                type: Array,
                required: true
            },
            posts: {
                type: Array,
                required: true
            },
            followedByMe: {
                required: false
            }
        },

        computed: {
            postsCount() {
                return this.posts.length;
            },

            followersCount() {
                return this.followers.length;
            },

            followingCount() {
                return this.following.length;
            },

            showFollowingButton() {
                return this.$user.id != this.user.id
            }
        },
    }
</script>

<style scoped>
    .profile-image {
        width: 150px;
        height: 150px;
    }

    .username {
        color: rgb(95, 93, 93);
    }

    ul {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 0;
    }

    ul li {
        list-style: none;
        font-size: 17px;
    }
</style>