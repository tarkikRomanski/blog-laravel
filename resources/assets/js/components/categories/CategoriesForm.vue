<template>
    <div class="categoryForm">
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> Your category has been saved successfully.
        </div>
        <form method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <label class="control-label" for="name">Category name:</label>
                    <input
                            type="text"
                            name="name"
                            id="name"
                            :class="{'is-invalid': errors.name} + ' form-control'"
                            v-model="category.name"
                    >
                    <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="description">Category description:</label>
                    <textarea
                            name="description"
                            id="description"
                            :class="{'is-invalid': errors.name} + ' form-control'"
                            v-model="category.description"
                    ></textarea>
                    <div v-if="errors.description" class="invalid-feedback">{{ errors.description[0] }}</div>
                </div>

                <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                saved: false,
                category: {
                    name: null,
                    description: null
                }
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
                this.saved = false;
                if(this.update === false) {
                    axios.post(this.getApiUrl('api/categories'), this.category)
                        .then(
                            ({data}) => {
                                this.setSuccessMessage();
                                this.setCategoryData(data);
                            }
                        )
                        .catch(({response}) => this.setErrors(response));
                } else {
                    axios.put(this.getApiUrl('api/categories/' + this.category.id), this.category)
                        .then(({data}) => this.setSuccessMessage())
                        .catch(({response}) => this.setErrors(response));
                }
            },

            fetch() {
                if (this.update !== false) {
                    axios.get(this.getApiUrl('api/categories/' + this.update))
                        .then(({data}) => this.setCategoryData(data.data));
                }
            },

            setCategoryData(data) {
                this.category.name = data.name;
                this.category.description = data.description;
                this.category.id = data.id;
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
            }
        }
    }
</script>