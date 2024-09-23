"use client";

import { cn } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
import { useState } from "react";
import googleLogo from "/public/google-icon.svg";
import visibilityIcon from "/public/visibility-icon.svg";
import visibilityOffIcon from "/public/visibility-off-icon.svg";

export default function page() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState({ value: "", visible: false });

  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    // loginMutation.mutate();
  };
  return (
    <div className="w-full bg-white py-[3.5rem]">
      <div className="mx-auto flex w-[25rem] flex-col">
        <h1 className="text-center text-[1.5625rem] font-semibold uppercase">
          Đăng nhập tài khoản
        </h1>
        <p className="mt-1 text-center text-[0.75rem] font-medium text-red-600 md:text-sm">
          {/* {errorMessageMap[error.general]} */}
          Tài khoản hoặc mật khẩu không chính xác
        </p>
        <form onSubmit={handleSubmit} className="mt-6 space-y-4">
          <div className="flex flex-col gap-2">
            <label htmlFor="email">
              Email <span className="text-red-600">*</span>
            </label>
            <input
              id="email"
              type="text"
              placeholder="Email"
              required
              className={cn(
                "boder-solid border border-app-carbon px-3 py-2 font-normal focus:outline-none",
              )}
            />
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="password">
              Mật khẩu <span className="text-red-600">*</span>
            </label>
            <div
              className={cn(
                "boder-solid flex flex-row border border-app-carbon",
              )}
            >
              <input
                id="password"
                type={password.visible ? "text" : "password"}
                placeholder="Mật khẩu"
                required
                className={cn("grow px-3 py-2 font-normal focus:outline-none")}
              />
              <div className="mr-[2%] flex h-10 w-[10%] cursor-pointer items-center justify-center">
                <Image
                  onClick={() =>
                    setPassword({ ...password, visible: !password.visible })
                  }
                  src={password.visible ? visibilityIcon : visibilityOffIcon}
                  alt=""
                />
              </div>
            </div>
          </div>
          <div>
            <Link href={"#"} className="float-right hover:underline">
              Quên mật khẩu?
            </Link>
          </div>
          <button
            type="submit"
            className="text-normal w-full border-[2px] border-solid border-[#266196] bg-white py-3 font-bold text-[#266196] transition-all duration-300 hover:bg-[#266196] hover:text-white"
          >
            Đăng nhập
          </button>
        </form>
        <div className="mx-auto mt-3 space-x-1">
          <span>Bạn chưa có tài khoản?</span>
          <Link href={"/register"} className="text-center font-bold">
            Đăng ký
          </Link>
        </div>
        <div className="mt-8">
          <div className="flex flex-row items-center justify-center gap-2">
            <div className="h-px w-[5rem] bg-app-carbon"></div>
            <div className="text-[0.875rem]">Hoặc đăng nhập với</div>
            <div className="h-px w-[5rem] bg-app-carbon"></div>
          </div>
          <div className="mt-4 flex justify-center">
            <button className="flex h-10 flex-row items-center gap-[0.625rem] rounded-[6.25rem] border border-solid border-[#747775] px-3 py-[0.625rem] shadow-lg transition-all duration-300 hover:border-[#5478B1] active:border-none active:bg-[#EEEEEE]">
              <Image src={googleLogo} alt="" className="size-[1.125rem]" />
              <span className="text-[0.875rem] font-medium leading-normal text-[#1F1F1F]">
                Đăng nhập với Google
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
