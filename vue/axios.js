import axios from "axios";
import echoClient from "./echo";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL,
    // withCredentials: true,
    headers: {
        Accept: "application/json",
    },
});

axiosClient.interceptors.request.use((config) => {
    // Add your headers to the config object
    config.headers["X-Socket-ID"] = echoClient.socketId();

    // Return the modified config object
    return config;
});
// axiosClient.interceptors.response.use(
//     (response) => Promise.resolve(response),
//     (error) => {
//         if (error.response.status == 401 || error.response.status == 419) {
//             const authentication = useAuthentication();
//             authentication.setAuthenticated(false);
//             router.push({ name: "resume" });
//         }

//         return Promise.reject(error);
//     }
// );

export default axiosClient;
