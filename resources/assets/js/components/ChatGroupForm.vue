<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="chats"  @keyup.enter="sendMessageGroup">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessageGroup">
                Send
            </button>
        </span>
    </div>
</template>

<script>


    export default {
       props: ['messages', 'groupid', 'userid'],

        data() {
            return {
                chats: ''
            }
        },



        methods: {
            sendMessageGroup() {
                this.$emit('newmessagegroup', {
                    message: this.chats,
                    group_id: this.groupid,
                    user_id: this.userid,
                });

                this.chats = ''
            }
        }    
    }
</script>