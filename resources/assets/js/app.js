
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
        //console.log(groupId)

        if(receiverId != undefined) {

            this.getPrivateChatfromUser(receiverId);

        }

      
        // Chat
        Echo.private('Chat.' + receiverId + '.' + senderId)
			.listen('MessageSent', (e) => {
			    this.messages.push({
			      message: e.message.message,
                  sender_id: e.senderid,
			      receiver_id: e.receiverid
			    });
			});


        // Chat Grup
        Echo.private('Chat-Group.' + groupId)
            .listen('NewMessageGroup', (e) => {
                this.messages.push({
                  message: e.message.message,
                });
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

        //get message chat grup
        if(groupId != undefined) {

            this.getChatGroup(groupId);

        }    
    },


    methods: {
        getPrivateChatfromUser(receiverId) {
            axios.get('/messages/'+receiverId).then(response => {
                console.log(response.data);
                this.messages = response.data;
            });
        },


        getChatGroup(groupId) {
            axios.get('/messages-group/'+groupId).then(response => {
                console.log(response.data);
                this.messages = response.data;
            });
        },


        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        },


        addMessageGroup(message) {
            this.messages.push(message);

            axios.post('/messages-group', message).then(response => {
              console.log(response.data);
            });
        },

     
    }
});


