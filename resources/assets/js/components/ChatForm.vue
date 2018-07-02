<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="chats"  @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>


    export default {
       props: ['messages', 'senderid', 'receiverid'],

        data() {
            return {
                chats: ''
            }
        },



        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    sender_id: this.senderid,
                    receiver_id: this.receiverid,
                    message: this.chats
                });

                this.chats = ''
            }
        }    
    }
</script>