<template>
    <div class="commentsList">
        <h3>Comments</h3>
        <div class="commentItem mb-3" v-for="comment in comments">
            <div class="card">
                <div class="card-header justify-content-between d-flex">
                    <h5>{{ comment.author }}</h5>
                    <a href="#" @click="destroy(comment.id)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>

                <div class="card-body">
                    {{ comment.content }}
                </div>
                <div class="card-footer">
                    <span class="text-muted">comented: {{ comment.created }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            };
        },

        props: {
            comments: {
                type: Object,
                default: {}
            }
        },

        methods: {
            destroy(id) {
                if(confirm('Are you sure you want to report this comment?')) {
                    axios.delete(this.getApiUrl('api/comments/'+id))
                        .then(response => this.removeComments(id));
                }
            },

            removeComments(id) {
                this.comments = _.remove(this.comments, function (comments) {
                    return comments.id !== id;
                });
            }
        }
    }
</script>