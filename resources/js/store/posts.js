export default {

    namespaced: true,

    state: {
        posts: []
    },

    getters: {

    },

    mutations: {
        PUSH_POSTS: (state, posts) => state.posts.push(posts)
    },

    actions: {
        async createPost({commit}, formData) {

            const { data } = await axios.post('/api/posts', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            });

            commit('PUSH_POSTS', data.post)

            return data;
        }
    }

}