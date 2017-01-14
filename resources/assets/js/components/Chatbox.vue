<template>
    <div id="chat">
        <div class="panel panel-default">
            <div class="panel-heading"><slot>Chat</slot></div>
            <div class="panel-body chat-messages">
                <chat-message v-for="message in messages" :message="message"></chat-message>
            </div>
        </div>
        <div class="form-group">
            <input @keyup.enter="sendCurrentMessage" v-model="currentMessage" type="text" class="form-control">
        </div>
    </div>
</template>

<script>
    import ChatMessage from './ChatMessage';
    export default {
        components: {
            'chat-message': ChatMessage
        },
        props: [
            'senderName'
        ],
        data() {
            return {
                messages: [],
                currentMessage: ''
            }
        },
        methods: {
            sendCurrentMessage() {
                this.messages.push({
                    message: this.currentMessage,
                    receivedAt: moment().format(),
                    senderName: this.senderName
                });

                axios.post('/chat', {
                    message: this.currentMessage
                });
                this.currentMessage = '';
            }
        },
        mounted() {
            Echo.channel('chat-channel').listen('ChatMessageReceived', (e) => {
                console.log(e);
                this.messages.push(e);
            });
        },
        updated() {
            let chat = this.$el.querySelector(".chat-messages");
            chat.scrollTop = chat.scrollHeight;
        }
    };
</script>
