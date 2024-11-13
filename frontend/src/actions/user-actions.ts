"use server";

import UserService from "@/services/UserService";

export const getUserInfo = async () => {
  try {
    const res = await UserService.getMe();
    return res.data.data;
  } catch (error) {
    console.error((error as any).response);
  }
  return null;
};
