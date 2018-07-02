<template lang="html">
    <div class="is-pulled-right">
        <div v-if="checkUser()">Online</div>
        <div v-else>Offline</div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'onlineusers'],
        methods: {
            checkUser: function() {
                return _.find(this.onlineusers, {id: this.user.id});
            }
        }
    }
</script>

<style lang="css">
    .red {
        color: red;
    }
    .green {
        color: green;
    }
</style>