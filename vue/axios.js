import axios from "axios";
import { echoClient } from "./echo";
import { useAuthentication } from "./src/stores/authentication";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL,
    headers: {
        Accept: "application/json",
    },
});

axiosClient.interceptors.request.use((config) => {
    config.headers["X-Socket-ID"] = echoClient.socketId();
    const authentication = useAuthentication();
    config.headers["Authorization"] = `Bearer ${authentication.token}`;

    return config;
});

export default axiosClient;
