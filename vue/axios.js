import axios from "axios";
const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL + "/api",
    // withCredentials: true,
    headers: { Accept: "application/json" },
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
