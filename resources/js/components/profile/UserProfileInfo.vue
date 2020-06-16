<template>
    <div class="row justify-content-center border-bottom pb-5">
        <div class="col-md-10 md-offset-2 d-flex flex-row align-items-center justify-content-start">
            <div>
                <img class="profile-image rounded-circle" :src="user.profile.avatar" />
            </div>
            <div class="ml-lg-5 pl-lg-5 w-50 d-flex flex-column justify-content-md-around h-100">
                <div class=" d-flex justify-content-between align-items-center mb-3">
                    <h2 class="username">{{ user.username }}</h2>
                    <button class="btn btn-sm btn-primary">Follow</button>
                </div>
                <div>
                    <ul>
                        <li>
                            <span class="font-weight-bold">14,362</span> posts
                        </li>
                        <li>
                            <span class="font-weight-bold">6.6m</span> followers
                        </li>
                        <li>
                            <span class="font-weight-bold">17</span> following
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