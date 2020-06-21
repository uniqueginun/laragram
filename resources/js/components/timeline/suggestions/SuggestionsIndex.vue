<template>
    <div class="d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between">
            <strong class="text-secondary">Suggestions for you</strong>
            <a href="/explorer/people">See all</a>
        </div>
        <div class="mt-3 d-flex flex-column align-items-center justify-content-between">
            <user-card class="py-2 w-100" v-for="user in suggestions" :user="user" :key="user.id">
                <a href="#" @click.prevent="follow(user)" class="btn btn-link text-decoration-none text-primary">
                    Follow
                </a>
            </user-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SuggestionsIndex",

        data: () => {
          return {
              suggestions: []
          }
        },

        methods: {
          async getSuggestions() {
              const { data } = await axios.get('/api/suggestions');
             this.suggestions = data.data
          },

          async follow(user) {
              await this.$store.dispatch('profile/follow', user)
              this.$toasted.show(`you're now following ${user.name}`)
              this.suggestions = this.suggestions.filter(u => u.id != user.id)
          }
        },

        mounted() {
            this.getSuggestions()
        }
    }
</script>

<style scoped>
    a {
        text-decoration: unset;
        color: #1b1e21;
        font-weight: 600;
        font-size: 13px;
    }
</style>