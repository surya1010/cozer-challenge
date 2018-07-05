
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.component('onlineuser', require('./components/OnlineUser.vue'));
Vue.component('create-group', require('./components/CreateGroup.vue'));
Vue.component('chat-messages-group', require('./components/ChatMessageGroup.vue'));


Vue.component('chat-form-group', require('./components/ChatGroupForm.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        onlineUsers: ''
    },

    created() {

        const senderId      = $('meta[name="senderId"]').attr('content');
        const receiverId    = $('meta[name="receiverId"]').attr('content');
        const groupId       = $('meta[name="groupId"]').attr('content');
        const user_group_id = $('meta[name="user_group_id"]').attr('content');

        if(receiverId != undefined) {
            this.getPrivateChatfromUser(receiverId);

        }

        //get message chat grup
        if(groupId != undefined) {
            console.log('group');
            
            this.getChatGroup(groupId);
        }

        // Listen Chat Private
        Echo.private('Chat.' + receiverId + '.' + senderId)
            .listen('MessageSent', (e) => {
                this.messages.push({
                  message: e.message.message,
                  sender_id: e.senderid,
                  receiver_id: e.receiverid
                });
            }); 


        // Listen Chat Grup
        Echo.private('Chat-Group.' + groupId)
            .listen('NewMessageGroup', (e) => {
                console.log(e)
                if(e.user.id != user_group_id)
                {
                    this.messages.push({
                      message: e.message,
                      group_id: groupId,
                      user_id: e.user.id,
                      user: e.user
                    });
                }
                
            }); 


        //Online
        if (senderId != 'null') {
            Echo.join('Online')
                .here((users) => {
                    this.onlineUsers = users;
                })
                .joining((user) => {
                    this.onlineUsers.push(user);
                })
                .leaving((user) => {
                    this.onlineUsers = this.onlineUsers.filter((u) => {u != user});
                });
        }

          
    },


    methods: {

        //get data chat base on user_id
        getPrivateChatfromUser(receiverId) {
            axios.get('/messages/'+receiverId).then(response => {
                this.messages = response.data;
            });
        },

        //get data chat group based on group id
        getChatGroup(groupId) {
            axios.get('/messages-group/'+groupId).then(response => {
                this.messages = response.data;
            });
        },


        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message).then(response => {
            });
        },


        addMessageGroup(message) {
            this.messages.push(message);
            axios.post('/messages-group', message).then(response => {

                this.getChatGroup(message.group_id);
            });
        },

     
    }
});


