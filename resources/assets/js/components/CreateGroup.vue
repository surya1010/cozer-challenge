<template>
    <form >
        
        <div class="panel-body">
            
            <div class="form-group">
                <label class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                    <input type="text" v-model="name" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Users</label>
                <div class="col-md-6">
                    <div class="form-check" v-for="user in initialUsers">
                        <input type="checkbox" class="form-check-input" v-bind:id="user.id" v-model="users" :value="user.id" >
                        <label class="form-check-label" v-bind:for="user.id" >{{ user.name }}</label>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="panel-footer">
            <div class="">
                <button type="submit"  class="btn btn-sm btn-flat btn-primary pull-right" @click.prevent="createGroup"> Save</button>
            </div>
        </div>

    </form>
</template>

<script>
  export default {

  		props: ['initialUsers'],

  		data() {
            return {
                name: '',
                users: []
            }
        },
        methods: {
            createGroup() {
                axios.post('/groups/store', {name: this.name, users: this.users})
                .then((response) => {
                    this.name = '';
                    this.users = [];
                    Bus.$emit('groupCreated', response.data);
                });
            }
        }

  }
</script>