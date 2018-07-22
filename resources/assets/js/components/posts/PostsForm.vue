<template>
    <div class="postForm">
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> Your post has been saved successfully.
        </div>
        <form method="post" @submit.prevent="onSubmit">
            <div class="form-group">
                <label class="control-label" for="name">Post name:</label>
                <input
                        type="text"
                        name="name"
                        id="name"
                        :class="{'is-invalid': errors.name} + ' form-control'"
                        v-model="post.name"
                >
                <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
            </div>

            <div class="form-group">
                <label class="control-label" for="content">Post content:</label>
                <froala :tag="'textarea'" :config="config" v-model="post.content"></froala>
            </div>

            <div class="form-group">
                <label class="control-label" for="file">Upload File:</label>
                <input type="file" id="file" ref="file" v-on:change="handleFileUpload"/>
            </div>

            <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                config: {
                    vueIgnoreAttrs: ['class', 'id']
                },
                errors: [],
                saved: false,
                post: {
                    name: null,
                    content: null
                },
                file: null,
                data: new FormData(),
            };
        },

        props: {
            update: {
                type: [String, Boolean],
                default: false
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            onSubmit() {
                this.data.append('name', this.post.name);
                this.data.append('content', this.post.content);
                this.data.append('file', this.file);
                this.saved = false;
                if(this.update === false) {
                    axios.post(this.getApiUrl('api/posts'),
                        this.data,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(
                            ({data}) => {
                                console.log(data);
                                this.setSuccessMessage();
                                this.setPostData(data);
                            }
                        )
                        .catch(({response}) => this.setErrors(response));
                } else {
                    axios.put(this.getApiUrl('api/posts/' + this.post.id), this.post)
                        .then(({data}) => this.setSuccessMessage())
                        .catch(({response}) => this.setErrors(response));
                }
            },

            fetch() {
                if (this.update !== false) {
                    axios.get(this.getApiUrl('api/posts/' + this.update))
                        .then(({data}) => this.setPostData(data.data));
                }
            },

            setPostData(data) {
                this.post.name = data.name;
                this.post.content = data.content;
                this.post.id = data.id;
            },

            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            setErrors(response) {
                this.errors = response.data.errors;
            },

            setSuccessMessage() {
                this.reset();
                this.saved = true;
            },

            reset() {
                this.errors = [];
                this.data = new FormData();
                this.file = null;
            }
        }
    }
</script>