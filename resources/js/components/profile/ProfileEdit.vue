<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" v-if="user" @submit.prevent="edit">
                        <div class="d-flex flex-row align-items-center mb-3">
                            <img :src="user.avatar" class="rounded-circle mr-2" width="100" height="100" />
                            <h4 class="text-primary">{{ user.name }} </h4>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="user.name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" v-model="user.username" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" v-model="user.email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea rows="5" v-model="user.profile.bio" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <input type="file" @change="handleFile" class="form-control-file" />
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" v-model="user.profile.url" class="form-control" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Edit Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileEdit",

        data: () => {
            return {
                user: null,
                avatar: null
            }
        },

        methods: {
            buildForm() {
                let form = new FormData();
                form.append('name', this.user.name)
                form.append('username', this.user.username)
                form.append('email', this.user.email)
                form.append('bio', this.user.profile.bio)
                form.append('url', this.user.profile.url)
                if (this.avatar) {
                    form.append('avatar', this.avatar)
                }
                return form;
            },

            async fetchUserInfo() {
                const { data } = await axios.get(`/api/users/${this.$user.username}?plain`)

                this.user = data.data
            },

            async edit() {

                const { data } =
                    await axios.post(`/api/profile/update`, this.buildForm(), {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });

                this.$toasted.show(data)
            },

            handleFile(e) {
                this.avatar = (e.target.files[0])
            }
        },

        created() {
            this.fetchUserInfo()
        }
    }
</script>

<style scoped>

</style>