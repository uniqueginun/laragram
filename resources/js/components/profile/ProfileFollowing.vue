<template>
    <button @click.prevent="following" class="btn btn-sm btn-primary">
        {{ followingLabel }}
    </button>
</template>

<script>
    export default {
        name: "ProfileFollowing",

        data: () => {
            return {
                followStatus: null
            }
        },

        props: {
            user: {
                type: Object,
                required: true
            },
            followedByMe: {
                required: false
            }
        },

        computed: {
            followingLabel() {
                return this.followStatus ? 'Unfollow' : 'Follow';
            },
            properAction() {
                return this.followStatus ? 'profile/unfollow' : 'profile/follow';
            }
        },

        methods: {
            following() {
                this.$store.dispatch(this.properAction, this.user).then(res => {
                    this.followStatus = ! this.followStatus
                })
            }
        },

        created() {
            this.followStatus = this.followedByMe ? true : false;
        }

    }
</script>

<style scoped>

</style>