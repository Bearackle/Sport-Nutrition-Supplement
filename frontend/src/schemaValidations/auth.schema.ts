import { z } from "zod";

export const LoginBody = z
  .object({
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
  })
  .strict();

export type LoginBodyType = z.TypeOf<typeof LoginBody>;

export const LoginRes = z.object({
  status: z.number(),
  message: z.string(),
  token: z.string(),
  expiresAt: z.string(),
  account: z.object({
    userId: z.number(),
    name: z.string(),
    email: z.string(),
    phone: z.string(),
  }),
});

export type LoginResType = z.TypeOf<typeof LoginRes>;

export const RegisterBody = z
  .object({
    fullName: z
      .string()
      .min(1, { message: "Họ và tên không được để trống" })
      .refine((value) => value.trim().split(/\s+/).length >= 2, {
        message: "Vui lòng nhập đầy đủ họ và tên",
      }),
    phone: z
      .string()
      .min(1, { message: "Số điện thoại không được để trống" })
      .regex(/(0)(3|5|7|8|9)+([0-9]{8})\b/, {
        message: "Số điện thoại không hợp lệ",
      })
      .max(10, { message: "Số điện thoại không hợp lệ" }),
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
  .strict()
  .superRefine((data, ctx) => {
    if (data.password !== data.confirmPassword) {
      ctx.addIssue({
        code: z.ZodIssueCode.custom,
        path: ["confirmPassword"],
        message: "Mật khẩu xác nhận không khớp với mật khẩu",
      });
    }
  });

export type RegisterBodyType = z.TypeOf<typeof RegisterBody>;

export const RegisterRes = LoginRes;

export type RegisterResType = z.TypeOf<typeof RegisterRes>;

export const ChangePasswordBody = z
  .object({
    currentPassword: z
      .string()
      .min(1, { message: "Mật khẩu hiện tại không được để trống" }),
    newPassword: z
      .string()
      .min(1, { message: "Mật khẩu mới không được để trống" }),
    confirmPassword: z
      .string()
      .min(1, { message: "Mật khẩu xác nhận không được để trống" }),
  })
  .strict();

export type ChangePasswordBodyType = z.TypeOf<typeof ChangePasswordBody>;

export const SlideSessionBody = z.object({}).strict();

export type SlideSessionBodyType = z.TypeOf<typeof SlideSessionBody>;

export const SlideSessionRes = RegisterRes;

export type SlideSessionResType = z.TypeOf<typeof SlideSessionRes>;
