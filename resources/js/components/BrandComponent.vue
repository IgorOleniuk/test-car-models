<template>
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header brand-card-header">
                        <span>Brands</span>
                        <button
                            v-if="admin"
                            class="btn btn-primary"
                            @click="openBrandModel('create')"
                        >
                            Add Brand
                        </button>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <ul class="items-list">
                            <li
                                v-for="brand in brandsData.data"
                                :key="brand.id"
                                class="list-item"
                            >
                                <a :href="'/' + brand.id + '/models'">{{ brand.brand }}</a>
                                <div v-if="admin">
                                    <i
                                        class="bi bi-pencil-fill"
                                        @click="openBrandModel('edit', brand)"
                                    >
                                    </i>
                                    <i
                                        class="bi bi-trash-fill"
                                        @click="openBrandModel('delete', brand)"
                                    >
                                    </i>
                                </div>
                            </li>
                        </ul>
                        <pagination
                            :data="{...brandsData}"
                            @pagination-change-page="getPaginatedBrands"
                            class="justify-content-center"
                        >
                            <span slot="prev-nav">&lt;</span>
                            <span slot="next-nav">&gt;</span>
                        </pagination>
                    </div>
                </div>
            </div>
        </div>

        <!-- The popup for creating/editing/deleting brands -->
        <div
            class="modal"
            id="brandModal"
            tabindex="-1"
            role="dialog"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span
                                aria-hidden="true"
                                @click="closeModal"
                            >
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="deleteModal">
                            <p>This is a 2 step action. By clicking 'Delete' button we will send
                                a confirmation letter to your email.
                            </p>
                        </div>
                        <div v-else>
                            <span v-if="isInputEmpty">{{ errorMessage }}</span>
                            <input
                                v-model="brandName"
                                type="text"
                                id="name"
                                placeholder="Enter brand name"
                                :class="{ empty_input: isInputEmpty }"
                                class="form-control"
                                required
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="deleteModal"
                            type="button"
                            class="btn btn-danger"
                            @click="deleteBrand"
                        >
                            Delete
                        </button>
                        <button
                            v-else
                            type="button"
                            class="btn btn-primary"
                            @click="saveBrand"
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="closeModal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                brandsData: [],
                modalTitle: '',
                brandName: '',
                brandId: null,
                isInputEmpty: false,
                errorMessage: 'Brand name is required',
                admin: this.$isAdmin,
                currentPage: 1,
                deleteModal: false,
            }
        },

        mounted() {
            this.getPaginatedBrands();
        },

        methods: {
            getPaginatedBrands(page = 1) {
                this.currentPage = page;

                axios.get('/api/brands?page=' + page)
                    .then((res) => {
                        this.brandsData = res.data;
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },

            openBrandModel(type, brand = []) {
                if (type === 'edit') {
                    this.modalTitle = 'Edit brand';
                } else if (type === 'create') {
                    this.modalTitle = 'Create new brand';
                } else if (type === 'delete') {
                    this.modalTitle = 'Are you sure you want to delete this brand?';
                    this.deleteModal = true;
                }
                $('#brandModal').modal('show');
                this.brandId = brand.id;
                this.brandName = brand.brand;
            },

            closeModal() {
                $('#brandModal').modal('hide');
                this.isInputEmpty = false;
            },

            saveBrand() {
                if (!this.brandName) this.isInputEmpty = true;

                let url = `/api/update-brand/${this.brandId}`;
                if (!this.brandId) {
                    url = '/api/create-brand';
                    this.currentPage = this.brandsData.meta.last_page;
                }

                axios.post(url, {
                    brand: this.brandName
                })
                    .then(() => {
                        this.closeModal();
                        this.getPaginatedBrands(this.currentPage);
                        this.$toast.success('The brand was saved', 'Success', {
                            timeout: 2000,
                            position: 'bottomRight'
                        });
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },

            deleteBrand() {
                axios.post('/api/delete-brand/' + this.brandId)
                    .then(() => {
                        this.closeModal();
                        this.$toast.success('We have sent the confirmation letter to your email', 'Success', {
                            timeout: 2000,
                            position: 'bottomRight'
                        });
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            }
        },
    }
</script>
