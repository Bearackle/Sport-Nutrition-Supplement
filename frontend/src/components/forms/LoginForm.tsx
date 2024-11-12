"use client";

import { loginAction } from "@/actions/auth-actions";
import { cn } from "@/lib/utils";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { useEffect } from "react";
import { useFormState } from "react-dom";
import { ZodErrors } from "../common/ZodErrors";
import { Button } from "../ui/button";
import { Input } from "../ui/input";
import { Label } from "../ui/label";

const INITIAL_STATE = {
  data: null,
  errors: null,
  message: null,
  zodErrors: null,
};

export const LoginForm = () => {
  const router = useRouter();
  const [formState, formAction] = useFormState(loginAction, INITIAL_STATE);

  useEffect(() => {
    if (formState?.message === "Login successful! Redirecting...") {
      const _timer = setTimeout(() => {
        router.replace("/"); // Chuyển hướng sau 2 giây
      }, 1000);
    }
  }, [formState]);
  return (
    <>
      {formState?.errors && (
        <p className="mt-1 text-center text-[0.75rem] font-medium text-red-600 md:text-sm">
          {formState.errors}
        </p>
      )}
      <form action={formAction} className="space-y-4">
        <div className="relative">
          <Label htmlFor="email">
            Email <span className="text-red-600">*</span>
          </Label>
          <Input
            id="email"
            name="email"
            type="text"
            placeholder="Email"
            className={cn(
              "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
            )}
          />
          <ZodErrors error={formState?.zodErrors?.email} />
        </div>

        <div className="relative">
          <Label htmlFor="password">
            Mật khẩu <span className="text-red-600">*</span>
          </Label>
          <Input
            id="password"
            name="password"
            type="password"
            placeholder="Mật khẩu"
            className={cn(
              "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
            )}
          />
          <ZodErrors error={formState?.zodErrors?.password} />
        </div>
        <div className="!mt-2">
          <Link href={"#"} className="float-right hover:underline">
            Quên mật khẩu?
          </Link>
        </div>
        <Button
          type="submit"
          className="h-auto w-full rounded-none border-[2px] border-solid border-[#1250DC] bg-[#1250DC] py-3 text-base font-bold text-white transition-all duration-200 hover:bg-[#1250DC]/[0.9]"
        >
          Đăng nhập
        </Button>
      </form>
    </>
  );
};
