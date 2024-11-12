import axiosClient from "./AxiosClient";

class UserService {
  static login({ email, password }: { email: string; password: string }) {
    return axiosClient.post("/account/login", { email, password });
  }

  static getMe() {
    return axiosClient.get("/account/profile");
  }
}

export default UserService;
