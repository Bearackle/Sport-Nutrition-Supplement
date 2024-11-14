"use server";
import {
  ChangePasswordBody,
  LoginBody,
  RegisterBody,
} from "@/schemaValidations/auth.schema";
import CookieService from "@/services/CookieService";
import UserService from "@/services/UserService";

export async function loginAction(prevState: any, formData: FormData) {
  const validatedFields = LoginBody.safeParse({
    email: formData.get("email"),
    password: formData.get("password"),
  });

  if (validatedFields.success) {
    try {
      const res = await UserService.login({
        email: validatedFields.data.email,
        password: validatedFields.data.password,
      });
      CookieService.setCookie("token", res.data.data.token, 1);

      return {
        data: null,
        errors: null,
        message: "Login successful! Redirecting...",
        zodErrors: null,
      };
    } catch (error) {
      return {
        ...prevState,
        errors: (error as any).response.data.error_message,
        message: "Failed to Login.",
      };
    }
  } else {
    return {
      ...prevState,
      errors: null,
      message: "Missing Fields. Failed to Login.",
      zodErrors: validatedFields.error.flatten().fieldErrors,
    };
  }
}

export async function registerAction(prevState: any, formData: FormData) {
  const validatedFields = RegisterBody.safeParse({
    fullName: formData.get("fullName"),
    tel: formData.get("tel"),
    email: formData.get("email"),
    password: formData.get("password"),
    confirmPassword: formData.get("confirmPassword"),
  });

  if (!validatedFields.success) {
    return {
      ...prevState,
      zodErrors: validatedFields.error.flatten().fieldErrors,
      strapiErrors: null,
      message: "Missing Fields. Failed to Register.",
    };
  }

  return {
    ...prevState,
    data: "ok",
  };
}

export async function changePasswordAction(prevState: any, formData: FormData) {
  const validatedFields = ChangePasswordBody.safeParse({
    currentPassword: formData.get("currentPassword"),
    newPassword: formData.get("newPassword"),
    confirmPassword: formData.get("confirmPassword"),
  });

  if (!validatedFields.success) {
    return {
      ...prevState,
      zodErrors: validatedFields.error.flatten().fieldErrors,
      strapiErrors: null,
      message: "Missing Fields. Failed to Change password.",
    };
  }

  return {
    ...prevState,
    data: "ok",
  };
}

export async function logoutAction() {
  CookieService.removeCookie("token");
}
