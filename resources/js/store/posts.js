export default {

    namespaced: true,

    state: {
        posts: [],
        followers: [],
        following: []
    },

    getters: {
        posts: state => state.posts,
        followers: state => state.followers,
        following: state => state.following
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
        },

        async fetchUserData ({commit}, user) {
            const { data } = await axios.get(`/api/users/${user.username}`)
            console.log(data)
        }
    }

}