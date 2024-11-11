"use client";
import { Button } from "@/components/ui/button";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { cn } from "@/lib/utils";
import { zodResolver } from "@hookform/resolvers/zod";
import Image from "next/image";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { z } from "zod";
import visibilityIcon from "/public/visibility-icon.svg";
import visibilityOffIcon from "/public/visibility-off-icon.svg";

const formSchema = z.object({
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

const page = () => {
  const [isVisible, setIsVisible] = useState({
    currentPassword: false,
    newPassword: false,
    confirmPassword: false,
  });
  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      currentPassword: "",
      newPassword: "",
      confirmPassword: "",
    },
  });

  function onSubmit(values: z.infer<typeof formSchema>) {
    // Do something with the form values.
    // ✅ This will be type-safe and validated.
    console.log(values);
  }
  return (
    <div className="w-full bg-white py-[3.5rem]">
      <div className="mx-auto flex w-[25rem] flex-col">
        <h1 className="mb-6 text-center text-[1.5625rem] font-semibold uppercase">
          Đổi mật khẩu
        </h1>
        <Form {...form}>
          <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-4">
            <FormField
              control={form.control}
              name="currentPassword"
              render={({ field }) => (
                <FormItem className="relative">
                  <FormLabel>
                    Mật khẩu hiện tại <span className="text-red-600">*</span>
                  </FormLabel>
                  <FormControl>
                    <Input
                      type={isVisible.currentPassword ? "text" : "password"}
                      placeholder="Mật khẩu hiện tại"
                      className={cn(
                        "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 text-base font-normal focus:outline-none",
                      )}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                  <div className="absolute bottom-0 right-0 z-[1] flex size-[2.625rem] cursor-pointer items-center justify-center">
                    <Image
                      onClick={() =>
                        setIsVisible({
                          ...isVisible,
                          currentPassword: !isVisible.currentPassword,
                        })
                      }
                      src={
                        isVisible.currentPassword
                          ? visibilityIcon
                          : visibilityOffIcon
                      }
                      alt=""
                    />
                  </div>
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="newPassword"
              render={({ field }) => (
                <FormItem className="relative">
                  <FormLabel>
                    Mật khẩu mới <span className="text-red-600">*</span>
                  </FormLabel>
                  <FormControl>
                    <Input
                      type={isVisible.newPassword ? "text" : "password"}
                      placeholder="Mật khẩu mới"
                      className={cn(
                        "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 text-base font-normal focus:outline-none",
                      )}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                  <div className="absolute bottom-0 right-0 z-[1] flex size-[2.625rem] cursor-pointer items-center justify-center">
                    <Image
                      onClick={() =>
                        setIsVisible({
                          ...isVisible,
                          newPassword: !isVisible.newPassword,
                        })
                      }
                      src={
                        isVisible.newPassword
                          ? visibilityIcon
                          : visibilityOffIcon
                      }
                      alt=""
                    />
                  </div>
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="confirmPassword"
              render={({ field }) => (
                <FormItem className="relative">
                  <FormLabel>
                    Nhập lại mật khẩu <span className="text-red-600">*</span>
                  </FormLabel>
                  <FormControl>
                    <Input
                      type={isVisible.confirmPassword ? "text" : "password"}
                      placeholder="Nhập lại mật khẩu"
                      className={cn(
                        "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 text-base font-normal focus:outline-none",
                      )}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                  <div className="absolute bottom-0 right-0 z-[1] flex size-[2.625rem] cursor-pointer items-center justify-center">
                    <Image
                      onClick={() =>
                        setIsVisible({
                          ...isVisible,
                          confirmPassword: !isVisible.confirmPassword,
                        })
                      }
                      src={
                        isVisible.confirmPassword
                          ? visibilityIcon
                          : visibilityOffIcon
                      }
                      alt=""
                    />
                  </div>
                </FormItem>
              )}
            />
            <Button
              type="submit"
              className="h-auto w-full rounded-none border-[2px] border-solid border-[#1250DC] bg-[#1250DC] py-3 text-base font-bold text-[#266196] text-white transition-all duration-200 hover:bg-[#1250DC]/[0.9]"
            >
              Xác nhận
            </Button>
          </form>
        </Form>
      </div>
    </div>
  );
};

export default page;
