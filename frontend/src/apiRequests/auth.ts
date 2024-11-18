import http from "@/lib/http";
import {
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
};

export default authApiRequest;
