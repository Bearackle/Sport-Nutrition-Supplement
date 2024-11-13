import axios from "axios";
import CookieService from "./CookieService";

const axiosClient = axios.create({
  baseURL: "http://dinhhuan.id.vn/api",
  headers: {
    "Content-Type": "application/json",
  },
});

axiosClient.interceptors.request.use(
  (config) => {
    const token = CookieService.getCookie("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    Promise.reject(error);
  },
);

axiosClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && error.response.status === 401) {
      CookieService.removeCookie("token");
    }
    return Promise.reject(error);
  },
);
export default axiosClient;
