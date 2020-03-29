<template>
    <li class="list-group-item" v-if="show">
        <div class="row">
            <div class="col-2 col-sm-1"><button class="btn-outline-dark" v-on:click="itemCheck">&nbsp;</button></div>
            <div class="col-10 col-sm-11">
                <a href="#" v-on:click="showDetails = true">{{ item.name }}</a>
                <div v-if="showDetails">
                    <select>
                        <option v-for="cat in categories" :key="cat.id">{{cat.name}}</option>
                    </select>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                show: true,
                showDetails: false,
            }
        },
        methods: {
            itemCheck: function() {
                axios.post('/grocery/list/'+this.list_id+'/item/'+this.item.id, {
                    _method: "DELETE"
                });
                this.show = false;
            },
            itemDetails: function() {
                // console.log(item);
            },
        },
        props: ['item', 'list_id']
    }
</script>
