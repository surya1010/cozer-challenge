<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix" >
                
                <div class="text-right" v-if="message.user.id == userid">
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.user.name }}
                        </strong>
                    </div>
                    <p>
                        {{ message.message }}
                    </p>
                </div>

                <div class="text-left" v-else>
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.user.name }}
                        </strong>
                    </div>
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
    props: ['messages', 'groupid', 'userid', 'user'],
    mounted() {
        console.log(this.userid);
    }
  };
</script>