import axios from 'axios';

const api = axios.create({
    baseURL: "http://127.0.0.1:8000", //your api URL
    headers:{
        common:{
            Authorization:`Bearer ${localStorage.getItem('@Auth:access_token')}`
        }
    }

});

export default api;