export default {

    namespaced: true,

    state: {
        posts: [],
        followers: [],
        following: [],
    },

    getters: {
        posts: state => state.posts.sort((a, b) => b.created_at - a.created_at),
        followers: state => state.followers,
        following: state => state.following,

    },

    mutations: {
        PUSH_POSTS: (state, posts) => state.posts.unshift(...posts),
        PUSH_FOLLOWERS: (state, followers) => state.followers.push(...followers),
        SET_FOLLOWERS: (state, followers) => state.followers = followers,
        PUSH_FOLLOWING: (state, following) => state.following.push(...following)
    },

    actions: {
        async fetchPosts({commit}, url) {
            const { data } = await axios.get(url)
            commit('PUSH_POSTS', data.data)
            return data;
        },

        async fetchUserData ({commit}, user) {
            const { data } = await axios.get(`/api/users/${user.username}`)
            commit('PUSH_FOLLOWERS', data.data.followers)
            commit('PUSH_FOLLOWING', data.data.following)
            return data;
        },

        async follow({commit}, user) {
            const { data } = await axios.post(`/api/profile/${user.profile.id}/follow`);
            commit('SET_FOLLOWERS', data)
            return data
        },

        async unfollow({commit}, user) {
            const { data } = await axios.post(`/api/profile/${user.profile.id}/follow`);
            commit('SET_FOLLOWERS', data)
            return data
        }
    }

}