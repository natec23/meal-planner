<template>
    <li class="list-group-item" v-if="show">
        <div class="row">
            <div class="col-2 col-sm-1">
                <div v-if="item.emoji" class="item-avatar" v-bind:style="{'background-color': category.color}">{{ item.emoji }}</div>
                <div v-else class="item-avatar" v-bind:style="{'background-color': category.color}">{{ item.name[0] }}</div>
            </div>
            <div class="col-8 col-sm-10">
                <a href="#" v-on:click.prevent="(editDetails ? editDetails = false : editDetails = true)">{{ item.name }}</a>
                <span v-if="(item.pivot.qty != 1 || item.pivot.unit || item.pivot.notes)">
                    <br />
                    <span v-if="(item.pivot.qty != 1 || item.pivot.unit)">{{ item.pivot.qty }} {{item.pivot.unit}}</span>
                    <span v-if="item.pivot.notes">{{ item.pivot.notes }}</span>
                </span>
            </div>
            <div class="col-2 col-sm-1"><button class="btn-outline-dark" v-on:click="itemCheck">&nbsp;</button></div>
        </div>
        <div class="row" v-if="editDetails">
            <div class="col-9">
                <div>
                    <label>Category</label>
                    <select v-model="item.category_id" v-on:change="itemProp" class="form-control" v-bind:class="{ 'is-valid' : propSuccess }">
                        <option v-for="cat in categories" :key="cat.id" v-bind:value="cat.id">{{cat.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <label>Emoji</label>
                <input type="text" class="form-control" v-model="item.emoji" v-on:change="itemProp" v-bind:class="{ 'is-valid' : propSuccess }" />
            </div>
        </div>
        <div class="row" v-if="editDetails">
            <div class="col-sm-6 col-md-3">
                <label for="qty">Quanity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" v-model="item.pivot.qty" v-on:change="itemUpdate" />
            </div>
            <div class="col-sm-6 col-md-3">
                <label for="unit">Unit</label>
                <input type="text" class="form-control" name="unit" id="unit" v-model="item.pivot.unit" v-on:change="itemUpdate">
            </div>
            <div class="col-md-6">
                <label for="notes">Notes</label>
                <textarea class="form-control" name="notes" id="notes" v-model="item.pivot.notes" v-on:change="itemUpdate"></textarea>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                propSuccess: false,
                show: true,
                editDetails: false,
            }
        },
        methods: {
            itemProp: function() {
                var self = this;
                axios.post('/grocery/item/'+this.item.id, {
                    _method: 'PUT',
                    'category_id': this.item.category_id,
                    'emoji': this.item.emoji
                }).then(function() {
                    self.propSuccess = true;
                    setTimeout(function(){
                        self.propSuccess = false;
                    }, 4000);
                });
            },
            itemCheck: function() {
                axios.post('/grocery/list/'+this.list_id+'/item/'+this.item.id, {
                    _method: "DELETE"
                });
                this.show = false;
            },
            itemUpdate: function() {
                axios.post('/grocery/list/'+this.list_id+'/item/'+this.item.id, {
                    _method: 'PUT',
                    'qty': this.item.pivot.qty,
                    'unit': this.item.pivot.unit,
                    'notes': this.item.pivot.notes
                }).then(function() {
                    self.categorySuccess = true;
                    setTimeout(function(){
                        self.categorySuccess = false;
                    }, 4000);
                });
            },
        },
        props: ['category', 'categories', 'item', 'list_id']
    }
</script>
