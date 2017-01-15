<template>
    <div id="chat">
        <div class="panel panel-default">
            <div class="panel-heading"><slot>Chat</slot></div>
            <div class="panel-body chat-window">
                <div class="row">
                    <div class="col-md-9 chat-messages">
                        <chat-message v-for="message in messages" :message="message"></chat-message>
                    </div>
                    <div class="col-md-3 chat-users">
                        <ul class="list-unstyled">
                            <li v-for="user in users">{{user.name}}</li>
                        </ul>
                    </div>
                </div>
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
                users: [],
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
            Echo.join('chat-channel')
                .here((users) => {
                    this.users = users;
                })
                .joining((joiningUser) => {
                    this.users.push(joiningUser);
                })
                .leaving((leavingUser) => {
                    this.users = collection.filter(this.users, user => user.id != leavingUser.id);
                });
        },
        updated() {
            let chat = this.$el.querySelector(".chat-messages");
            chat.scrollTop = chat.scrollHeight;
        }
    };
</script>

<style lang="scss">
    .chat-window {
        height: 500px;
        .row {
            height: 100%;
        }
        .chat-messages {
            height: 100%;
            overflow: auto;
        }
        .chat-users {
            border-left: 2px solid grey;
            height: 100%;
            .list-unstyled li {
                margin-bottom: 20px;
            }
        }
    }
</style>
