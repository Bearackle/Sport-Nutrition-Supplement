"use client";
import { useAppContext } from "@/app/app-provider";
import { Avatar, AvatarFallback } from "@/components/ui/avatar";
import { cn, getContrastingColor, stringToColor } from "@/lib/utils";
import Link from "next/link";

export default function Page() {
  const { user } = useAppContext();
  return (
    <div className={cn("w-full rounded-[0.625em] bg-white pb-[2.5em]")}>
      <div
        className={cn(
          "w-full border-b-[0.125em] border-solid border-[#EDF0F3] pb-[1em] pl-[2em] pt-[1.5em] text-[1em] font-bold leading-[1.21]",
        )}
      >
        Thông tin cá nhân
      </div>
      <div className="flex w-full flex-col items-center pt-[1em]">
        <Avatar
          className={cn("size-[5.625em]")}
          style={{
            backgroundColor: `${stringToColor(user?.name || "undefined undefined")}`,
          }}
        >
          <AvatarFallback
            className={cn("text-[1.75em]")}
            style={{
              color: `${getContrastingColor(stringToColor(user?.name || "undefined undefined"))}`,
            }}
          >
            {`${user?.name.split(" ").slice(-2).join(" ").split(" ")[0][0]}${user?.name.split(" ").slice(-2).join(" ").split(" ")[1][0]}`}
          </AvatarFallback>
        </Avatar>
        <div className="mt-[1em] w-[20.375em] divide-y text-[0.875em] leading-[1.21] text-[#333]">
          <div
            className={cn("flex w-full flex-row justify-between py-[0.875em]")}
          >
            <span>Họ và tên</span>
            <span>{user?.name}</span>
          </div>
          <div
            className={cn("flex w-full flex-row justify-between py-[0.875em]")}
          >
            <span>Số điện thoại</span>
            <span>{user?.phone}</span>
          </div>
          <div
            className={cn("flex w-full flex-row justify-between py-[0.875em]")}
          >
            <span>Email</span>
            <span>{user?.email}</span>
          </div>
        </div>
        <Link
          href="/change-password"
          className="mx-auto mt-[3.5em] rounded-[1.25em] bg-[#004FFF]/[0.23] px-[2.5em] py-[0.75em] text-[1em] font-bold leading-[1.21] text-[#1F5ADD] transition-all duration-200 hover:bg-[#004FFF]/[0.3]"
        >
          Đổi mật khẩu
        </Link>
      </div>
    </div>
  );
}
