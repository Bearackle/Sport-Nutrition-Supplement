import http from "@/lib/http";
import { ProfileResType } from "@/schemaValidations/account.schema";
import {
  ChangePasswordBodyType,
  LoginBodyType,
  LoginResType,
  RegisterBodyType,
  RegisterResType,
} from "@/schemaValidations/auth.schema";

const authApiRequest = {
  login: (body: LoginBodyType) =>
    http.post<LoginResType>("/account/login", body),
  register: (body: RegisterBodyType) =>
    http.post<RegisterResType>("/account/register", body),
  auth: (body: { sessionToken: string; expiresAt: string }) =>
    http.post("/api/auth", body, {
      baseUrl: "",
    }),
  logout: () => http.delete("/api/auth", { baseUrl: "" }),
  changePassword: (body: ChangePasswordBodyType) =>
    http.patch("/account/change-password", body),
  profile: () => http.get<ProfileResType>("/account/profile"),
};

export default authApiRequest;
