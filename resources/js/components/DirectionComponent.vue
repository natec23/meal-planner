<template>
    <li class="list-group-item" style="display: list-item;">
        <button type="button" v-if="edit" class="float-right btn" v-on:click="editDirection"><i class="fas fa-edit"></i></button>
        <span v-if="direction.heading">
            <h3 style="display:inline;">{{ direction.heading }}</h3>
            <p>{{ direction.details }}</p>
        </span>
        <span v-else>
            <h3 style="display:inline;">{{ direction.details }}</h3>
        </span>
    </li>
</template>

<script>
    export default {
        methods: {
            editDirection: function() {
                this.$root.directionModal(this.direction);
            },
        },
        props: ['edit', 'direction']
    }
</script>
