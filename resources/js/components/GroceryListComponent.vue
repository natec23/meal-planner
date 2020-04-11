<template>
    <div>
        <div v-for="category in categories" :key="category.id">
            <div class="card" v-if="typeof groceryItems[category.id] != 'undefined'">
                <div class="card-header" v-bind:style="{ 'background-color': category.color }">{{ category.name }}</div>
                <ul class="list-group list-group-flush">
                    <grocery-item v-for="item in groceryItems[category.id]" :key="item.id" v-bind:item="item" v-bind:list_id="list" v-bind:category="category" v-bind:categories="categories"></grocery-item>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                groceryItems: []
            }
        },
        methods: {
            categoriesResponse: function(response) {
                this.categories = response.data;
            },
            getItems() {
                axios.get('/grocery/list/'+this.list+'/items').then(this.itemsResponse);
            },
            itemsResponse: function(response) {
                this.groceryItems = response.data;
            },
            itemDetails: function(item) {
                console.log(item);
            },
        },
        mounted: function() {
            axios.get('/grocery/category').then(this.categoriesResponse);
            this.getItems();
        },
        props: ['list']
    }
</script>
