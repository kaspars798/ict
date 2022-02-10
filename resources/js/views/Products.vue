<template>
    <div>
        <h1>Products Page</h1>
        <div>
            <div v-if="loading">
                Data is loading ...
            </div>
            <div v-else>
                <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                    <div class="col d-flex align-items-stretch" 
                    v-for="(product, column) in productsInRow(row)" 
                    :key="'row' + row + column">
                        <products-list-item 
                            v-bind="product" />
                    </div>
                    <div class="col"
                    v-for="p in placeholdersInRow(row)"
                    :key="'placeholder' + row + p">
                    </div>
                </div>
                <div class="col-12 mt-4 pt-2">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item"><a :class="['page-link', page==1?'text-secondary':'']" @click="prev" aria-label="Previous">Prev</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ page }} of {{ pagination_meta.last_page }}</a></li>
                        <li class="page-item"><a :class="['page-link', page==pagination_meta.last_page?'text-secondary':'']" @click="next" aria-label="Next">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductsListItem from './ProductsListItem.vue'

export default {
    components: {
        ProductsListItem
    },
    data() {
        return {
            page: 1,
            products: null,
            pagination_meta: null,
            loading: false,
            columns: 3,
            headers: null
        }
    },
    computed: {
        rows() {
            return (this.products ? Math.ceil(this.products.length / this.columns) : 0)
        }
    },
    methods: {
        productsInRow(row) {
            return this.products.slice((row - 1) * this.columns, row * this.columns)
        },
        placeholdersInRow(row) {
            return this.columns - this.productsInRow(row).length
        },
        getResults() {
            this.axios
                .get("/api/products?page=" + this.page, {headers: this.headers})
                .then(response => {
                    this.products = response.data.data
                    this.pagination_meta = response.data.meta
                    this.loading = false
                });
        },
        prev() {
            if(this.page > 1) {
                this.page--
                this.getResults()
            }
        },
        next() {
            if(this.page < this.pagination_meta.last_page) {
                this.page++
                this.getResults()
            }
        }
    },
    created() {
        this.loading = true
        this.headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
        this.getResults()
    }
}
</script>
