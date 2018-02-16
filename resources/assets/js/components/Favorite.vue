
<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(store)">
            <div class="fave-heart is_animating"></div>
        </a>
        <a href="#" v-else @click.prevent="favorite(store)">
            <div class="fave-heart"></div>
        </a>
    </span>
</template>

<script>
    export default {
        props: ['store', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(store) {
                axios.post('/favorite/'+store)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(store) {
                axios.post('/unfavorite/'+store)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
