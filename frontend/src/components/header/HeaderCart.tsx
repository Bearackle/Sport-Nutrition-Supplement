"use client";
import { useAppContext } from "@/app/app-provider";
import Image from "next/image";
import Link from "next/link";
import cartIcon from "/public/cart-icon.svg";

export const HeaderCart = () => {
  const { isAuthenticated } = useAppContext();
  return (
    <div className="hidden xl:block">
      <Link
        href={isAuthenticated ? "/gio-hang" : "/dang-nhap"}
        className="flex flex-row items-center gap-2 rounded-[3.125rem] bg-[#1250DC] px-4 py-2"
      >
        <Image src={cartIcon} alt="" className="size-7" />
        <p className="text-center text-[0.875rem] font-semibold tracking-[0.025rem] text-white">
          Giỏ hàng
        </p>
      </Link>
    </div>
  );
};
