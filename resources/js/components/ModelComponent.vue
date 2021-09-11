<template>
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header models-header">
                        <a
                            href="/"
                            class="back-to-brands"
                        >
                            Back to Brands
                        </a>
                        <span>Brand Models</span>
                        <input
                            type="text"
                            placeholder="Find a model"
                            class="form-control model-search"
                            v-model="searchQuery"
                            @input="findModel"
                        >
                    </div>
                    <div class="card-body d-flex flex-column">
                        <ul class="items-list">
                            <li
                                v-for="model in carModels"
                                :key="model.id"
                                class="list-item"
                            >
                                {{ model.model }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        id: {
            type: Number,
            default: null
        }
    },

    data() {
        return {
            carModels: [],
            searchQuery: '',
        }
    },

    mounted() {
        this.getModels();
    },

    methods: {
        getModels() {
            axios.get('/api/' + this.id + '/models')
                .then((res) => {
                    console.log(res.data.data);
                    this.carModels = res.data.data;
                })
                .catch((e) => {
                    console.log(e);
                });
        },

        findModel() {
            axios.post('/api/' + this.id + '/car-model-search', {
                search_query: this.searchQuery
            })
                .then((res) => {
                    this.carModels = res.data.data;
                })
                .catch((e) => {
                    console.log(e);
                });
        }
    }
}
</script>
