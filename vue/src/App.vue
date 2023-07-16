<template>
    <div class="chatroom" :class="{ 'dark-mode': darkMode }">
        <div class="chatroom-container">
            <div class="chatroom-header">
                <h2>Dark Chatroom</h2>
                <div>
                    <button @click="toggleDarkMode" class="dark-mode-button">
                        <span v-if="darkMode">Light Mode</span>
                        <span v-else>Dark Mode</span>
                    </button>
                    <button
                        class="dark-mode-button leave-btn"
                        @click="leaveChannel"
                        v-if="hasJoinedChannel"
                        v-auto-animate
                    >
                        Leave Channel
                    </button>
                </div>
            </div>
            <div class="chatroom-content">
                <div
                    class="chatroom-messages"
                    v-auto-animate
                    ref="chatMessagesRef"
                >
                    <div
                        v-for="message in chatMessages"
                        :key="message.time"
                        class="chatroom-message"
                        :class="{ isSender: message.isTheSender ?? false }"
                    >
                        <img
                            src="data:image/png;base64,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"
                            alt="Profile"
                            class="profile-img"
                        />
                        <div class="message-details">
                            <div class="message-sender">
                                {{ message.user.name }}
                            </div>
                            <div class="message-bubble">
                                <p class="message-text">
                                    {{ message.text }}
                                </p>
                                <p class="message-time">
                                    {{ message.created_at }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flag flag--bottom"
                        v-if="showTyping"
                        v-auto-animate
                    >
                        <div class="flag__media">
                            <div class="watson">
                                <div class="watson__icon">
                                    <div class="watson__top"></div>
                                    <div class="watson__middle"></div>
                                    <div class="watson__bottom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flag__body">
                            <div class="message">
                                <div class="message__bubble">
                                    <p>
                                        {{ typists.join(",") }}
                                        <span>{{
                                            typists.length > 1
                                                ? " are "
                                                : " is "
                                        }}</span>
                                        typing&hellip;
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-auto-animate>
                    <form
                        v-if="hasJoinedChannel"
                        @submit.prevent="sendMessage"
                        class="chatroom-form"
                        v-auto-animate
                    >
                        <input
                            v-model="newMessage"
                            type="text"
                            placeholder="Type your message"
                        />
                        <button type="submit">Send</button>
                    </form>
                    <form
                        v-else
                        @submit.prevent="joinChannel"
                        class="chatroom-form"
                        v-auto-animate
                    >
                        <input
                            v-model="name"
                            type="text"
                            placeholder="Enter your name"
                        />
                        <button type="submit">Join Chat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, nextTick, reactive, ref, watch } from "vue";
import { useAuthentication } from "./stores/authentication";
import { echoClient, initEcho } from "./../echo";
import axiosClient from "../axios";
import { infoToast, successToast, errorToast } from "./composables/toast";

const authentication = useAuthentication();
initEcho();
const darkMode = ref(true);
const chatMessagesRef = ref();
const chatMessages = ref([]);
const newMessage = ref("");
const name = ref("");
const isTyping = ref(false);
const showTyping = ref(false);
const typists = ref([]);
const chatChannel = ref(null);
const typingTimer = ref(null);

const hasJoinedChannel = computed(() => {
    return chatChannel.value;
});

const leaveChannel = () => {
    echoClient.leave("chat");
    chatChannel.value = null;
};

const registerAndLogin = async () => {
    const res = await axiosClient.post("/api/auth", { name: name.value });
    authentication.token = res.data.token;
};

const getMessages = async () => {
    const res = await axiosClient.get("/api/messages");
    chatMessages.value = res.data.messages;
    await nextTick();
    chatMessagesRef.value.scrollTop = chatMessagesRef.value.scrollHeight;
};

const typeWhisperCallback = (data) => {
    if (data.typing) {
        typists.value.push(data.typist);
        showTyping.value = true;
    } else {
        const indexToRemove = typists.value.indexOf(data.typist);
        if (indexToRemove !== -1) {
            typists.value.splice(indexToRemove, 1);
        }

        if (typists.value.length === 0) showTyping.value = false;
    }
};

const registerPresenceEvents = () => {
    chatChannel.value
        .here((user) => {
            successToast("You joined the channel!!");
        })
        .joining((user) => {
            infoToast(user.name + " joined the channel!!");
        })
        .leaving((user) => {
            infoToast(user.name + " have left the channel!!");
        });
};

const joinChannel = async () => {
    await registerAndLogin();
    await getMessages();

    initEcho();
    chatChannel.value = echoClient.join("chat");
    registerPresenceEvents();

    chatChannel.value.listen("MessageSent", (e) => {
        chatMessages.value.push(e.message);
    });

    chatChannel.value.listenForWhisper("typing", typeWhisperCallback);
};

const sendMessage = async () => {
    if (newMessage.value) {
        const res = await axiosClient.post("/api/messages", {
            text: newMessage.value,
        });
        chatMessages.value.push({ ...res.data.message, isTheSender: true });
        newMessage.value = "";
    }
};

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
};

//TODO : what if someone changes their frontEnd received game, so other will recieve the wrong and edited name
const setTypingStatus = (status) => {
    isTyping.value = status;
    chatChannel.value.whisper("typing", {
        typing: status,
        typist: name.value,
    });
};

const clearTypingTimer = () => {
    if (typingTimer.value) {
        clearTimeout(typingTimer.value);
        typingTimer.value = null;
    }
};

const startTypingTimer = () => {
    clearTypingTimer();

    typingTimer.value = setTimeout(() => {
        setTypingStatus(false);
    }, 2500);
};

watch(newMessage, (newVal, prevVal) => {
    if (chatChannel.value && newVal !== prevVal && newVal !== "") {
        if (!isTyping.value) {
            setTypingStatus(true);
        }

        startTypingTimer();
    }
});
</script>

<style lang="scss">
.chatroom-container {
    width: min(97%, 1200px); /* Set the desired maximum width */
    margin: auto auto;
    display: flex;
    flex-direction: column;
    height: min(40em, 90%);

    border: 2px solid rgba(0, 0, 0, 0.1); /* Use a subtle border color with transparency */
    background-color: #b8b4b4;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
}

.dark-mode .chatroom-container {
    border-color: rgba(
        255,
        255,
        255,
        0.1
    ); /* Adjust the border color for dark mode */
    background-color: #5f5e5e;
    box-shadow: 0 5px 10px rgba(255, 255, 255, 0.1); /* Box shadow for dark mode */
}

body {
    margin: 0;
    padding: 0;
    height: 100vh;
}

.chatroom {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background-color: #f5f5f5;
    background-image: url(https://via.placeholder.com/1200x800/e0e0e0/FFFFFF);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    transition: all 0.3s ease-in-out;
}

.chatroom.dark-mode {
    background-image: url(https://via.placeholder.com/1200x800/282c34/FFFFFF);
    /* Adjust the border color for dark mode */ /* Use a subtle border color with transparency */
}

.leave-btn {
    transition: all 0.4s ease-in-out !important;
    border-radius: 0.2em;
}

.leave-btn:hover {
    background-color: #ff6666;
}

.chatroom-header {
    padding: 0.7em;
    background-color: transparent;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatroom-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chatroom-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.chatroom-message {
    display: flex;
    gap: 0.5em;
    align-items: flex-start;
    margin-bottom: 10px;
    min-width: 10em;
    flex-direction: row;
    justify-content: left;
    text-align: left;
}

.chatroom-message.isSender {
    text-align: right;
    flex-direction: row-reverse;
    justify-content: right;

    .message-bubble {
        background-color: #dcf8c6;
        border-radius: 12px 0 12px 12px;
    }
}

.profile-img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
    border-radius: 50%;
}

.message-details {
    display: flex;
    flex-direction: column;
}

.message-sender {
    font-weight: bold;
    margin-bottom: 5px;
}

.message-bubble {
    background-color: white;
    padding: 0.4em 1.2em;
    max-width: min(90%, 30em); /* Limit the width of the message bubble */
    border-radius: 0 12px 12px 12px;
}

.message-text {
    margin: 0;
    font-size: 1rem;
    color: #1f1e1e; /* Black text color */
    word-break: break-word; /* Allow long words to break */
    line-height: 1.6;
    letter-spacing: 0.7px;
}

.dark-mode .message-sender {
    color: #15171b;
}

.message-time {
    margin-top: 0.5em;
    font-size: 12px;
    color: #666;
}

.dark-mode .message-time {
    color: #999999;
}

.chatroom-form {
    padding: 4px;
    background-color: #fff;
    display: flex;
    align-items: center;
    border-radius: 10px;
    margin: 10px;
}

input[type="text"] {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
}

button[type="submit"] {
    background-color: #005ca9;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

.dark-mode-button {
    background-color: transparent;
    border: none;
    color: #ffffff;
    cursor: pointer;
    padding: 0.5rem;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

/* .dark-mode-button:hover {
    background-color: rgba(255, 255, 255, 0.2);
} */

.dark-mode-button span {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.dark-mode-button span:first-child {
    background-color: #ffffff;
    color: #1a5074;
}

.dark-mode-button span:last-child {
    background-color: #1a5074;
    color: #ffffff;
}

.flag {
    display: flex;
    justify-content: left;

    &--bottom {
        align-items: flex-end;
    }

    &__media {
        display: inherit;
        align-items: inherit;
        flex: 0 0 auto;

        margin-right: 0.5rem;
    }

    &__body {
        display: initial;

        min-width: 0;
        width: auto;
    }
}

.message {
    &__stamp {
        font-size: 0.75rem;
        line-height: 1.3333;
        font-weight: 600;

        padding: 0 0.75rem;
        margin-bottom: 0.5rem;
    }

    &__bubble {
        font-size: 0.875rem;
        line-height: 1.4285;
        color: #767676;

        border-radius: 1.125rem;
        background-color: #f4f4f4;

        padding: 0.5rem 0.75rem;
    }
}

.watson {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 2.25rem;
    height: 2.25rem;
    border-radius: 1.125rem;

    &__icon {
        position: relative;

        width: 0.25rem;
        height: 1.25rem;
    }

    &__top,
    &__middle,
    &__bottom {
        position: absolute;
        top: 0.5rem;

        width: 0.25rem;
        height: 0.25rem;
        background-color: #3151b7;
        border-radius: 0.125rem;

        transition-timing-function: ease-in-out;
    }

    &__top {
        animation: bounce--top 1.125s infinite;
    }

    &__bottom {
        animation: bounce--bottom 1.125s infinite;
    }
}

@keyframes bounce--top {
    0% {
        top: 0.5rem;
    }
    50% {
        top: 0;
    }
    100% {
        top: 0.5rem;
    }
}

@keyframes bounce--bottom {
    0% {
        top: 0.5rem;
    }
    50% {
        top: 1rem;
    }
    100% {
        top: 0.5rem;
    }
}
</style>
