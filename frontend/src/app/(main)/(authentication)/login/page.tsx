"use client";

import { LoginForm } from "@/components/forms/LoginForm";
import Image from "next/image";
import { Fragment } from "react";
import googleLogo from "/public/google-icon.svg";

export default function page() {
  return (
    <Fragment>
      <h1 className="text-center text-[1.5625rem] font-semibold uppercase">
        Đăng nhập tài khoản
      </h1>
      <LoginForm />
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
    </Fragment>
  );
}
