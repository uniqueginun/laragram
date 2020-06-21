const currentUser = window.location.pathname.replace('/', '');

export default {
    namespaced: true,

    actions: {
        async createPost({commit}, formData) {

            const { data } = await axios.post('/api/posts', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            });

            if(data.post.user.username === currentUser) {
                commit('profile/PUSH_POSTS', [data.post], { root: true })
            }

            return data;
        }
    }

}