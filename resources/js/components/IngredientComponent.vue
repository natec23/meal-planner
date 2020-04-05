<template>
    <li class="list-group-item" v-bind:class="{'list-group-item-light' : ingredient.optional}">
        <button type="button" v-if="edit" class="float-right btn" v-on:click="editIngredient"><i class="fas fa-edit"></i></button>
        <h3 v-if="ingredient.item">
            {{ ingredient.item.name }}
            <small class="text-muted">
                <span v-if="ingredient.amount">{{ ingredient.amount }}</span>
                <span v-if="ingredient.unit">{{ ingredient.unit}}</span>
            </small>
        </h3>
        <p class="text-muted" v-if="ingredient.notes">{{ ingredient.notes }}</p>
    </li>
</template>

<script>
    export default {
        methods: {
            editIngredient: function() {
                this.$root.ingredientModal(this.ingredient);
            },
        },
        props: ['edit', 'ingredient']
    }
</script>
<style scoped>
h3 {margin-bottom: 0px;}
p {margin-bottom: 0px;}
</style>
