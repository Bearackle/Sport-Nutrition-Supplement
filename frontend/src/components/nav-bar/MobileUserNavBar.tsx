import Image from "next/image";
import Link from "next/link";
import accountIcon from "/public/account-icon.svg";

export const MobileUserNavBar = () => {
  return (
    <Link href="/login" className="flex flex-row items-center gap-4 px-4 py-3">
      <Image src={accountIcon} alt="" className="size-8" />
      <div>
        <p className="text-center text-base font-bold text-white">Tài khoản</p>
        <p className="text-center text-[0.875rem] font-medium text-white">
          Đăng nhập
        </p>
      </div>
    </Link>
  );
};
