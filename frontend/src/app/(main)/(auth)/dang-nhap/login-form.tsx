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
import { LoginBody, LoginBodyType } from "@/schemaValidations/auth.schema";
import { zodResolver } from "@hookform/resolvers/zod";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { Fragment, useState } from "react";
import { useForm } from "react-hook-form";

const LoginForm = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const { setUser } = useAppContext();
  const { toast } = useToast();
  const router = useRouter();
  const form = useForm<LoginBodyType>({
    resolver: zodResolver(LoginBody),
    defaultValues: {
      email: "",
      password: "",
    },
  });

  async function onSubmit(values: LoginBodyType) {
    if (loading) return;
    setLoading(true);
    setError(null);
    try {
      const result = await authApiRequest.login(values);

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
      setError("Tài khoản hoặc mật khẩu không chính xác");
    } finally {
      setLoading(false);
    }
  }
  return (
    <Fragment>
      <CustomLoadingAnimation isLoading={loading} />
      {error && (
        <p className="mt-1 text-center text-[0.75rem] font-medium text-red-600 md:text-sm">
          {error}
        </p>
      )}
      <Form {...form}>
        <form
          onSubmit={form.handleSubmit(onSubmit)}
          className="w-full max-w-[600px] flex-shrink-0 space-y-2"
          noValidate
        >
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
                      "!h-auto !rounded-none border border-solid border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
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
                      "!h-auto !rounded-none border border-solid border-app-carbon px-3 py-2 pr-[2.625rem] text-base font-normal focus:outline-none",
                    )}
                    {...field}
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            )}
          />
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
      </Form>
    </Fragment>
  );
};

export default LoginForm;
