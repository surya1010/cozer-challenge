<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="text-right" v-if="message.sender_id == senderid">
                    <p>
                        {{ message.message }}
                    </p>
                </div>

                <div class="text-left" v-else>

                    <p>
                        {{ message.message }}
                    </p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages', 'senderid', 'receiverid'],
    mounted() {
        console.log(this.messages);
    }
  };
</script>