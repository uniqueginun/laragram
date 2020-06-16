<template>
    <div>
        <user-profile-info v-if="user" :user="user" />
    </div>
</template>

<script>

    import { mapActions } from 'vuex'

    export default {

        name: "UserProfile",

        props: {
            user: {
                type: Object,
                required: true
            }
        },

        methods: {
            ...mapActions({
                fetchUserData: 'posts/fetchUserData'
            })
        },

        mounted() {

            this.fetchUserData(this.user)

        }

    }

</script>

<style scoped>

</style>