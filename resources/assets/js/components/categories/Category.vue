<template>
    <div>
        <header>
            <h1>{{ category.name }}</h1>
            <p>{{ category.description }}</p>
        </header>
        <posts  v-if="category.id" :category="category.id"></posts>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: {}
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
                axios.get(this.getApiUrl('api/categories/'+this.id))
                    .then(({data}) => {
                        this.category = data.data;
                    });
            },
        }
    }
</script>