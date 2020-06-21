export default {
    namespaced: true,

    state: {
        posts: [],
        user_likes: [],
        user_replies: []
    },

    getters: {
        posts: state => state.posts,
        user_likes: state => state.user_likes,
        user_replies: state => state.user_replies,
    },

    mutations: {
        PUSH_POSTS: (state, posts) => state.posts.push(...posts),
        PUSH_LIKES: (state, likes) => {
            state.user_likes.push(...likes)
        },
        PUSH_REPLIES: (state, replies) => state.user_replies.push(...replies),
        POP_LIKE: (state, id) => {
            state.user_likes = state.user_likes.filter(like => like != id)
            state.posts.map(post => {
                if (post.id == id) {
                    post.likes--;
                }
                return post;
            })
        },
        POP_POST: (state, payload) => state.posts = state.posts.map(item => {
            if (item.id == payload.id) {
                item = payload
            }
            return item;
        }),
        PUSH_LIKE: (state, like) => {
            state.user_likes.push(like)
            state.posts.map(post => {
                if (post.id == like) {
                    post.likes++;
                }
                return post;
            })
        },
    },

    actions: {
        async grabPosts({commit}, url) {
            const { data } = await axios.get(url);
            commit('PUSH_POSTS', data.data);
            commit('PUSH_LIKES', data.user_likes);
            commit('PUSH_REPLIES', data.user_replies);
            return data;
        },

        async toggleLike({commit}, post) {
            const { data } = await axios.post(`/api/likes/${post.id}/like`)
            switch(data.type)
            {
                case "like":
                    commit('PUSH_LIKE', post.id);
                    break;

                case "unlike":
                    commit('POP_LIKE', post.id);
                    break;
            }
            return data;
        },

        async replyToPost({commit, getters}, {id, body}) {
            const { data } = await axios.post(`/api/comments/${id}/add`, {
                body
            })

            if (!getters.user_replies.includes(id)) {
                commit('PUSH_REPLIES', [id])
            }
            commit('POP_POST', data.data)
        }
    }
}