<template>
    <div class="d-flex justify-content-between align-items-center flex-row">
        <div class="d-flex flex-row align-items-center w-100">
            <img class="rounded-circle mr-3" width="40" height="40" :src="user.avatar" />
            <div class="d-flex flex-row w-100">
                <span class="font-weight-bolder mr-auto"><h5>{{ user.username }}</h5></span>
                <slot />
            </div>
        </div>
        <div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "UserCard",

        props: {
            user: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>