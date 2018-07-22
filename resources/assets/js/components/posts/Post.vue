<template>
    <div class="postItem">
        <h1 class="postItem__name">{{ post.name }}</h1>
        <div class="postItem__content">
            {{ post.content }}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                post: {}
            };
        },

        props: {
            id: {
                type: [String],
                default: false
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get(this.getApiUrl('api/posts/'+this.id))
                    .then(({data}) => {
                        this.post = data.data;
                    });
            },
        }
    }
</script>