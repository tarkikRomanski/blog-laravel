<template>
    <div>
        <h1>{{ category.name }}</h1>
        <p>{{ category.description }}</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: null
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