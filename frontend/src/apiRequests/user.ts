import http from "@/lib/http";
import { ProfileResType } from "@/schemaValidations/account.schema";

const userApiRequest = {
  getProfile: () => http.get<ProfileResType>("/user/info"),
};

export default userApiRequest;
