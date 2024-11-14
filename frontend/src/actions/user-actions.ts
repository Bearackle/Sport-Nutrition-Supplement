"use server";

import UserService from "@/services/UserService";
import CookieService from "@/services/CookieService";

export const getUserInfo = async () => {
  try {
    const res = await UserService.getMe();
    return res.data.data;
  } catch (error) {
    console.error((error as any).response);
  }
  return null;
};

export const getProfile = async () => {
  const token = CookieService.getCookie("token");
  const res = await fetch(
    `${process.env.NEXT_PUBLIC_API_URL}/account/profile`,
    {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    },
  );
  return await res.json();
};
