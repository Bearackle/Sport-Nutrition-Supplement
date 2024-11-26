"use client";

import authApiRequest from "@/apiRequests/auth";
import { useAppContext } from "@/app/app-provider";
import CustomLoadingAnimation from "@/components/common/CustomLoadingAnimation";
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
import { useToast } from "@/hooks/use-toast";
import { cn, handleErrorApi } from "@/lib/utils";
import {
  RegisterBody,
  RegisterBodyType,
} from "@/schemaValidations/auth.schema";
import { zodResolver } from "@hookform/resolvers/zod";
import { useRouter } from "next/navigation";
import { Fragment, useState } from "react";
import { useForm } from "react-hook-form";

const RegisterForm = () => {
  const [loading, setLoading] = useState(false);
  const { setUser } = useAppContext();
  const { toast } = useToast();
  const router = useRouter();

  const form = useForm<RegisterBodyType>({
    resolver: zodResolver(RegisterBody),
    defaultValues: {
      name: "",
      phone: "",
      email: "",
      password: "",
      confirmPassword: "",
    },
  });

  async function onSubmit(values: RegisterBodyType) {
    if (loading) return;
    setLoading(true);
    try {
      const result = await authApiRequest.register(values);

      await authApiRequest.auth({
        sessionToken: result.payload.token,
        expiresAt: result.payload.expiresAt,
      });
      localStorage.setItem("sessionToken", result.payload.token);
      localStorage.setItem("sessionTokenExpiresAt", result.payload.expiresAt);

      toast({
        variant: "success",
        title: result.payload.message,
      });
      setUser(result.payload.account);
      router.push("/");
      router.refresh();
    } catch (error: any) {
      handleErrorApi({
        error,
        setError: form.setError,
      });
    } finally {
      setLoading(false);
    }
  }
  return (
    <Fragment>
      <CustomLoadingAnimation isLoading={loading} />
      <Form {...form}>
        <form
          onSubmit={form.handleSubmit(onSubmit)}
          className="w-full max-w-[600px] flex-shrink-0 space-y-2"
          noValidate
        >
          <FormField
            control={form.control}
            name="name"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Họ và tên</FormLabel>
                <FormControl>
                  <Input
                    placeholder="Họ và tên"
                    type="text"
                    className={cn(
                      "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="phone"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Số điện thoại</FormLabel>
                <FormControl>
                  <Input
                    placeholder="Số điện thoại"
                    type="text"
                    className={cn(
                      "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="email"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Email</FormLabel>
                <FormControl>
                  <Input
                    placeholder="Email"
                    type="email"
                    className={cn(
                      "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="password"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Mật khẩu</FormLabel>
                <FormControl>
                  <Input
                    placeholder="Mật khẩu"
                    type="password"
                    className={cn(
                      "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="confirmPassword"
            render={({ field }) => (
              <FormItem>
                <FormLabel>Nhập lại mật khẩu</FormLabel>
                <FormControl>
                  <Input
                    placeholder="Nhập lại mật khẩu"
                    type="password"
                    className={cn(
                      "boder-solid !h-auto !rounded-none border border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
          <Button
            type="submit"
            className="!mt-4 h-auto w-full rounded-none border-[2px] border-solid border-[#1250DC] bg-[#1250DC] py-3 text-base font-bold text-white transition-all duration-200 hover:bg-[#1250DC]/[0.9]"
          >
            Đăng ký
          </Button>
        </form>
      </Form>
    </Fragment>
  );
};

export default RegisterForm;
