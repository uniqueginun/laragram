<template>
    <li class="nav-item">
        <a class="nav-link" href="#" @click.prevent="lunchModal">
            <i class="fab fa-instagram fa-2x"></i>
        </a>
    </li>
</template>

<script>
    export default {

        methods: {
            lunchModal() {
                console.log('modal lunched...');
            }
        }

    }
</script>
