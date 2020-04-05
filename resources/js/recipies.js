Vue.component('recipie-ingredient', require('./components/IngredientComponent.vue').default);
Vue.component('recipie-direction', require('./components/DirectionComponent.vue').default);

const app = new Vue({
    el: '#recipie-container',
    data: {
        directions: [],
        directionEdit: {},
        ingredients: [],
        ingredientEdit: {},
        modalDirection: false,
        modalIngredient: false
    },
    methods: {
        /**
         * Directions
         */
        getDirections: function() {
            var self = this;
            axios.get('/recipies/direction/'+recipie_id).then(function(response){
                self.directions = response.data;
            });
            this.modalDirection = false;
        },
        addDirection: function() {
            this.directionModal({});
        },
        directionModal: function(edit) {
            edit._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            this.directionEdit = edit;
            this.modalDirection = true;
        },
        saveDirection: function() {
            if(this.directionEdit.id) {
                this.directionEdit._method = 'PUT';
                axios.post('/recipies/direction/'+this.directionEdit.id, this.directionEdit)
                .then(this.getDirections);
            }
            else {
                axios.post('/recipies/direction/'+recipie_id, this.directionEdit)
                .then(this.getDirections);
            }
        },
        /**
         * Ingredients
         */

        getIngredients: function() {
            var self = this;
            axios.get('/recipies/ingredient/'+recipie_id).then(function(response){
                self.ingredients = response.data;
            });
            this.modalIngredient = false;
        },
        addIngredient: function() {
            this.ingredientModal({});
        },
        // opens the modal to create a new ingredient
        ingredientModal: function(edit) {
            edit._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if(edit.item) {
                edit.name = edit.item.name;
            }
            this.ingredientEdit = edit;
            this.modalIngredient = true;
        },
        saveIngredient: function() {
            if(this.ingredientEdit.id) {
                this.ingredientEdit._method = 'PUT';
                axios.post('/recipies/ingredient/'+this.ingredientEdit.id, this.ingredientEdit)
                .then(this.getIngredients);
            }
            else {
                axios.post('/recipies/ingredient/'+recipie_id, this.ingredientEdit)
                .then(this.getIngredients);
            }
        },
    },
    mounted: function() {
        if(recipie_id) {
            this.getIngredients();
            this.getDirections();
        }
    }
});
