<template>

    <div class="postList">
        <div class="row">
            <div class="card col-lg-4 col-12 col-md-6" v-for="post in posts">
                <div class="card-img-top postList__img">
                    <img v-if="post.fileType == 1" :src="post.file" alt="Post image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ post.name }}</h5>
                    <p class="card-text">{{ post.shortContent }}</p>
                    <a :href="post.link" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
        <paginate v-if="pageCount > 1"
                :page-count="pageCount"
                :click-handler="fetch"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'">
        </paginate>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                pageCount: 1,
                endpoint: this.getApiUrl('api/posts?page=')
            };
        },

        props: {
            category: [Number, String]
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page + '&category=' + this.category)
                    .then(({data}) => {
                        this.posts = data.data;
                        this.pageCount = data.meta.last_page;
                    });
            }
        }
    }
</script>