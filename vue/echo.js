import Pusher from "pusher-js";
import Echo from "laravel-echo";
import { useAuthentication } from "./src/stores/authentication";
window.Pusher = Pusher;
Pusher.logToConsole = true;

export let echoClient = null;
export function initEcho() {
    echoClient = new Echo({
        broadcaster: "pusher",
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
        wsHost: import.meta.env.VITE_PUSHER_HOST
            ? import.meta.env.VITE_PUSHER_HOST
            : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
        wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
        wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
        forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
        enabledTransports: ["ws", "wss"],
        authEndpoint: import.meta.env.VITE_BACKEND_URL + "/broadcasting/auth",
        auth: {
            headers: {
                Authorization: `Bearer ${useAuthentication().token}`,
                Accept: "application/json",
            },
        },
    });
}
