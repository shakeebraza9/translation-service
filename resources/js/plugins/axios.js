import axios from 'axios'


const api = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}`, 
    withCredentials: true, 
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
})


api.interceptors.request.use((config) => {
    return config
})

const token = localStorage.getItem("auth_token");
if (token) {
  api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

export default api