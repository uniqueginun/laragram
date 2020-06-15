<template>
    <li class="nav-item">
        <a class="nav-link" href="#" @click.prevent="lunchModal">
            <i class="fab fa-instagram fa-2x"></i>
        </a>
    </li>
</template>

<script>
    import CreatePostForm from "./CreatePostForm";

    export default {

        methods: {
            lunchModal() {
                this.$modal.show(CreatePostForm, {}, {
                    draggable: true
                })
            }
        }

    }
</script>
