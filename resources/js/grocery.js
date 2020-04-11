Vue.component('grocery-list', require('./components/GroceryListComponent.vue').default);
Vue.component('grocery-item', require('./components/GroceryItemComponent.vue').default);
const groceryApp = new Vue({
    el: '#grocery-container',
    data: {
        list: list_id,
        newItem: ""
    },
    methods: {
        addItem: function(event) {
            axios.post(event.target.action, {
                list_id : this.list,
                name : this.newItem
            }).then(function(){
                groceryApp.$refs.grocerylist.getItems();
            });
            this.newItem = '';
        }
    }
});
