"use client";
import { useAppContext } from "@/app/app-provider";
import { cn, getContrastingColor, stringToColor } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
import { Avatar, AvatarFallback } from "../ui/avatar";
import accountIcon from "/public/account-icon.svg";
import cartIcon from "/public/cart-icon.svg";

export const UserAndCart = () => {
  const { user, isAuthenticated } = useAppContext();
  const MobileUser = () => {
    if (user) {
      return (
        <Link
          href="/user/profile"
          className="flex max-w-[9rem] flex-row items-center gap-2"
        >
          <div className="flex size-6 shrink-0 items-center justify-center rounded-full bg-white/50 xs:size-8">
            <Avatar
              className={cn("size-5 xs:size-7")}
              style={{
                backgroundColor: `${stringToColor(user?.name)}`,
              }}
            >
              <AvatarFallback
                className={cn("text-xs xs:text-sm")}
                style={{
                  color: `${getContrastingColor(stringToColor(user?.name))}`,
                }}
              >
                {`${user?.name.split(" ")[0][0]}${user?.name.split(" ")[1][0]}`}
              </AvatarFallback>
            </Avatar>
          </div>
          <div className="line-clamp-1 hidden shrink-0 text-center text-sm font-semibold capitalize leading-none text-white md:flex">
            {user?.name.split(" ").slice(-2).join(" ")}
          </div>
        </Link>
      );
    }

    return (
      <Link href="/login" className="flex flex-row items-center gap-2">
        <Image src={accountIcon} alt="" className="size-5 xs:size-7" />
        <p className="hidden text-center text-[0.875rem] font-semibold text-white lg:block">
          Đăng nhập
        </p>
      </Link>
    );
  };
  return (
    <div className="absolute right-[4%] flex flex-row items-center gap-1 xs:gap-4 xl:hidden">
      <MobileUser />
      <div>
        <Link
          href={isAuthenticated ? "/cart" : "/login"}
          className="flex flex-row items-center gap-2 rounded-[3.125rem] px-4 py-2 lg:bg-[#1250DC]"
        >
          <Image src={cartIcon} alt="" className="size-5 xs:size-7" />
          <p className="hidden text-center text-[0.875rem] font-semibold tracking-[0.025rem] text-white lg:block">
            Giỏ hàng
          </p>
        </Link>
      </div>
    </div>
  );
};
