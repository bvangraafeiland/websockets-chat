<template>
    <div class="chat-message">
        <div class="header">
            <p><strong>{{ message.senderName }}:</strong></p>
            <p>{{ momentReceived }}</p>
        </div>
        <div>
            {{ message.message }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        computed: {
            momentReceived() {
                return moment(this.message.receivedAt).toDate().toLocaleTimeString();
            }
        }
    }
</script>

<style lang="scss">
    .chat-message {
        .header {
            display: flex;
            justify-content: space-between;
        }
        margin-bottom: 2em;
    }
</style>