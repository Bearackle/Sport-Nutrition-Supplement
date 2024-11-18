"use client";

import { changePasswordAction } from "@/actions/auth-actions";
import { cn } from "@/lib/utils";
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

export function ChangePasswordForm() {
  const [formState, formAction] = useFormState(
    changePasswordAction,
    INITIAL_STATE,
  );
  console.log(formState);
  return (
    <form action={formAction} className="space-y-4">
      <div className="relative">
        <Label htmlFor="currentPassword">
          Mật khẩu hiện tại <span className="text-red-600">*</span>
        </Label>
        <Input
          id="currentPassword"
          name="currentPassword"
          type="password"
          placeholder="Mật khẩu hiện tại"
          className={cn(
            "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
          )}
        />
        <ZodErrors error={formState?.zodErrors?.currentPassword} />
      </div>

      <div className="relative">
        <Label htmlFor="newPassword">
          Mật khẩu mới <span className="text-red-600">*</span>
        </Label>
        <Input
          id="newPassword"
          name="newPassword"
          type="password"
          placeholder="Mật khẩu mới"
          className={cn(
            "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
          )}
        />
        <ZodErrors error={formState?.zodErrors?.newPassword} />
      </div>
      <div className="relative">
        <Label htmlFor="confirmPassword">
          Nhập lại mật khẩu <span className="text-red-600">*</span>
        </Label>
        <Input
          id="confirmPassword"
          name="confirmPassword"
          type="password"
          placeholder="Nhập lại mật khẩu"
          className={cn(
            "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
          )}
        />
        <ZodErrors error={formState?.zodErrors?.confirmPassword} />
      </div>
      <Button
        type="submit"
        className="h-auto w-full rounded-none border-[2px] border-solid border-[#1250DC] bg-[#1250DC] py-3 text-base font-bold text-white transition-all duration-200 hover:bg-[#1250DC]/[0.9]"
      >
        Xác nhận
      </Button>
    </form>
  );
}
