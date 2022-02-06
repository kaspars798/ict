<template>
    <div>
        <h1>Products Page</h1>
        <div>
            <div v-if="loading">
                Data is loading ...
            </div>
            <div v-else>
                <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                    <div class="col" 
                    v-for="(product, column) in productsInRow(row)" 
                    :key="'row' + row + column">
                        <products-list-item 
                            :itemName="product.name" 
                            :itemDescription="product.description" />
                    </div>
                    <div class="col"
                    v-for="p in placeholdersInRow(row)"
                    :key="'placeholder' + row + p">
                    </div>
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
            products: null,
            loading: false,
            columns: 3
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
        }
    },
    created() {
        this.loading = true
        setTimeout(() => {
            this.products = [
                {
                    name: "Chips",
                    description: "Crounchy tasty chips"
                },
                {
                    name: "Milk",
                    description: "Milk from country"
                },
                {
                    name: "Bread",
                    description: "Dark bread"
                },
                {
                    name: "Spoon",
                    description: "Silver spoon"
                }
            ]
            this.loading = false
        }, 2000)
    }
}
</script>
