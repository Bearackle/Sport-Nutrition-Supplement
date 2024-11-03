import { Avatar, AvatarFallback } from "@/components/ui/avatar";
import { cn, getContrastingColor, stringToColor } from "@/lib/utils";
import Link from "next/link";

export default function Page() {
  return (
    <div className={cn("w-full rounded-[0.625rem] bg-white pb-10")}>
      <div
        className={cn(
          "w-full border-b-[2px] border-solid border-[#EDF0F3] pb-4 pl-8 pt-6 text-base font-bold leading-[1.21]",
        )}
      >
        Thông tin cá nhân
      </div>
      <div className="flex w-full flex-col items-center pt-4">
        <Avatar
          className={cn("size-[5.625rem]")}
          style={{
            backgroundColor: `${stringToColor("Lê Quốc Hưng")}`,
          }}
        >
          <AvatarFallback
            className={cn("text-[1.75rem]")}
            style={{
              color: `${getContrastingColor(stringToColor("Lê Quốc Hưng"))}`,
            }}
          >
            {`${"Lê Quốc Hưng".split(" ")[0][0]}${"Lê Quốc Hưng".split(" ")[1][0]}`}
          </AvatarFallback>
        </Avatar>
        <div className="mt-4 w-[20.375rem] divide-y text-[0.875rem] leading-[1.21] text-[#333]">
          <div className={cn("flex w-full flex-row justify-between py-3.5")}>
            <span>Họ và tên</span>
            <span>Lê Quốc Hưng</span>
          </div>
          <div className={cn("flex w-full flex-row justify-between py-3.5")}>
            <span>Số điện thoại</span>
            <span>0969696969</span>
          </div>
          <div className={cn("flex w-full flex-row justify-between py-3.5")}>
            <span>Email</span>
            <span>quochung@gmail.com</span>
          </div>
        </div>
        <Link
          href="/change-password"
          className="mx-auto mt-14 rounded-[1.25rem] bg-[#004FFF]/[0.23] px-10 py-3 text-base font-bold leading-[1.21] text-[#1F5ADD] transition-all duration-200 hover:bg-[#004FFF]/[0.3]"
        >
          Đổi mật khẩu
        </Link>
      </div>
    </div>
  );
}
