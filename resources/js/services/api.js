import axios from 'axios';

const api = axios.create({
  baseURL: '/api/game/',
});

export default api;
