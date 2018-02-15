
<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(spa)">
            <div class="fave-heart is_animating"></div>
        </a>
        <a href="#" v-else @click.prevent="favorite(spa)">
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
            favorite(spa) {
                axios.post('/favorite/'+spa)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(spa) {
                axios.post('/unfavorite/'+spa)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>