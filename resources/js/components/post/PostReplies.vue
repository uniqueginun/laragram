<template>
    <div class="py-3 mb-auto">
        <timeline-post-replies :post="post" />
    </div>
</template>

<script>
    export default {
        name: "PostReplies",

        props: {
            post: {
                required: true,
                type: Object
            }
        },
    }
</script>

<style scoped>

</style>