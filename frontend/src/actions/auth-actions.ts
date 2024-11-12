"use server";
import CookieService from "@/services/CookieService";
import UserService from "@/services/UserService";
import { redirect } from "next/navigation";
import { z } from "zod";

const schemaLogin = z.object({
  email: z.string().superRefine((value, ctx) => {
    if (value.length === 0) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        message: "Email không được để trống",
      });
    } else if (!z.string().email().safeParse(value).success) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        message: "Email không hợp lệ",
      });
    }
  }),
  password: z.string().min(1, { message: "Mật khẩu không được để trống" }),
});

export async function loginAction(prevState: any, formData: FormData) {
  const validatedFields = schemaLogin.safeParse({
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

const schemaRegister = z
  .object({
    fullName: z
      .string()
      .min(1, { message: "Họ và tên không được để trống" })
      .refine((value) => value.trim().split(/\s+/).length >= 2, {
        message: "Vui lòng nhập đầy đủ họ và tên",
      }),
    tel: z
      .string()
      .min(1, { message: "Số điện thoại không được để trống" })
      .regex(/(0)(3|5|7|8|9)+([0-9]{8})\b/, {
        message: "Số điện thoại không hợp lệ",
      })
      .max(10, { message: "Số điện thoại không hợp lệ" }),
    email: z
      .string()
      .min(1, { message: "Email không được để trống" })
      .email({ message: "Email không hợp lệ" }),
    password: z
      .string()
      .min(1, { message: "Mật khẩu không được để trống" })
      .regex(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/, {
        message:
          "Mật khẩu phải chứa ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt",
      }),
    confirmPassword: z
      .string()
      .min(1, { message: "Mật khẩu xác nhận không được để trống" }),
  })
  .superRefine((data, ctx) => {
    if (data.password !== data.confirmPassword) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        path: ["confirmPassword"],
        message: "Mật khẩu xác nhận không khớp với mật khẩu",
      });
    }
  });

export async function registerAction(prevState: any, formData: FormData) {
  const validatedFields = schemaRegister.safeParse({
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

const schemaChangePassword = z.object({
  currentPassword: z
    .string()
    .min(1, { message: "Mật khẩu hiện tại không được để trống" }),
  newPassword: z
    .string()
    .min(1, { message: "Mật khẩu mới không được để trống" }),
  confirmPassword: z
    .string()
    .min(1, { message: "Mật khẩu xác nhận không được để trống" }),
});

export async function changePasswordAction(prevState: any, formData: FormData) {
  const validatedFields = schemaChangePassword.safeParse({
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
  redirect("/login");
}
