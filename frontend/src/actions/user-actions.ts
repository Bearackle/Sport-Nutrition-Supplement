"use server";

import Util from "@/lib/utils";
import CookieService from "@/services/CookieService";
import UserService from "@/services/UserService";

export const getUserInfo = async () => {
  const token = CookieService.getCookie("token");

  if (token && Util.isTokenValid(token)) {
    const res = await UserService.getMe();
    return res.data;
  }
  return null;
};
