<template>
    <form class="md-form" @submit.prevent="publish">
        <div class="form-group pb-4">
            <h5 class="font-weight-bold text-md-center">Upload Post</h5>
        </div>
        <div class="form-group">
            <label class="file-upload btn btn-light btn-block">
                Browse for files ... <input type="file" @change="handleFileUpload" multiple />
            </label>
            <span v-if="errors.images && errors.images.length" class="invalid-feedback" role="alert">
                <strong>{{ errors.images[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <input type="text" v-model="post.caption" placeholder="Post Caption" class="form-control" />
        </div>
        <div class="form-group">
             <button type="submit" class="btn btn-secondary btn-block">Upload Post</button>
        </div>
    </form>
</template>

<script>
    export default {

        data: () => {
            return {
                post: {
                    images: [],
                    caption: 'post caption'
                },

                media: [],

                allowedTypes: [],

                errors: {
                    images: [],
                    caption: []
                }
            }
        },

        methods: {
            handleFileUpload(e) {
                Array.from(e.target.files).forEach(file => {
                    if (this.allowedTypes.includes(file.type)) {
                        this.media.push(file)
                    }
                })
            },

            async getAllowedTypes() {
                const { data } = await axios.get('/media/types');
                this.allowedTypes = data.types.images
            },

            async publish() {

                if (!this.media.length) {
                    this.errors.images = ['الرجاء إختيار ملف أو أكثر']
                    return;
                }


                let form = new FormData();

                this.media.forEach((img, index) => {
                    form.append(`media[${index}]`, img);
                })

                this.$store.dispatch('posts/createPost', form).then(res => {
                    console.log(res)
                }).then(() => {
                    this.clean()
                })

            },

            clean() {
                this.media = []
                this.post.images = []
                this.post.caption = ''
                this.errors.caption = []
                this.errors.images = []
                this.$emit('close')
            }
        },

        mounted() {
            this.getAllowedTypes();
        }
    }
</script>

<style scoped>

</style>