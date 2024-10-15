import { nunito } from "@/lib/font";
import { cn } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
import MobileNavBar from "../nav-bar/MobileNavBar";
import SearchInput from "./SearchInput";
import accountIcon from "/public/account-icon.svg";
import cartIcon from "/public/cart-icon.svg";
import logo from "/public/logo.png";
import phoneIcon from "/public/phone-icon.svg";
import saleIcon from "/public/sale-icon.svg";
import saleTag from "/public/sale-tag.svg";
import trackingIcon from "/public/tracking-icon.svg";

export const Header = () => {
  return (
    <header
      className="pb-2 xl:pb-0"
      style={{
        background:
          "linear-gradient(180deg, rgba(63,133,233,1) 0%, rgba(48,116,225,1) 50%, rgba(37,105,222,1) 100%)",
      }}
    >
      <div
        className={cn(
          "relative mx-auto flex max-w-[75rem] flex-col items-center justify-center px-8 pb-1 pt-2",
          "xl:h-[6.75rem] xl:flex-row xl:justify-between xl:py-2",
        )}
      >
        <div className="absolute right-9 top-2 hidden flex-row items-center gap-1 xl:flex">
          <Image src={phoneIcon} alt="phone" className="size-4" />
          <p className="text-center text-[0.75rem] font-semibold text-white">
            Tel: 033 330 3802
          </p>
        </div>
        <MobileNavBar />
        <Link
          href="/"
          className={cn(
            "mx-auto flex flex-row items-center xl:mx-0",
            "xs:-translate-x-6 -translate-x-4 xl:-translate-x-0",
          )}
          title="4H Store"
        >
          <Image
            src={logo}
            alt="logo"
            className="xs:size-16 size-12 xl:size-20"
          />
          <p
            className={cn(
              nunito.className,
              "xs:text-[0.75rem] xs:max-w-[15rem] max-w-[10rem] text-center text-[0.5rem] font-extrabold uppercase text-white",
            )}
          >
            Thực phẩm dinh dưỡng thể thao sport nutrition supplement
          </p>
        </Link>
        <div className={cn("relative hidden w-fit xl:block", nunito.className)}>
          <SearchInput />
          <div
            className={cn(
              "absolute -bottom-7 left-4 flex flex-row items-center gap-6 text-[0.75rem] font-bold italic text-white",
            )}
          >
            <Link href="#" className="flex flex-row items-center gap-1">
              <Image src={saleIcon} alt="" className="size-6" />
              <span>Hot Deals</span>
            </Link>
            <Link href="#" className="flex flex-row items-center">
              <Image src={trackingIcon} alt="" className="size-5" />
              <span>Tra cứu đơn hàng</span>
            </Link>
            <Link href="#" className="flex flex-row items-center">
              <Image src={saleTag} alt="" className="size-6" />
              <span>Xả kho hàng</span>
            </Link>
          </div>
        </div>
        <Link
          href="login"
          className="hidden flex-row items-center gap-2 xl:flex"
        >
          <Image src={accountIcon} alt="" className="size-7" />
          <p className="text-center text-[0.875rem] font-semibold text-white">
            Đăng nhập
          </p>
        </Link>
        <div className="hidden xl:block">
          <button className="flex flex-row items-center gap-2 rounded-[3.125rem] bg-[#1250DC] px-4 py-2">
            <Image src={cartIcon} alt="" className="size-7" />
            <p className="text-center text-[0.875rem] font-semibold tracking-[0.025rem] text-white">
              Giỏ hàng
            </p>
          </button>
        </div>
        <div className="xs:gap-4 absolute right-[4%] flex flex-row items-center gap-1 xl:hidden">
          <Link href="login" className="flex flex-row items-center gap-2">
            <Image src={accountIcon} alt="" className="xs:size-7 size-5" />
            <p className="hidden text-center text-[0.875rem] font-semibold text-white lg:block">
              Đăng nhập
            </p>
          </Link>
          <div>
            <button className="flex flex-row items-center gap-2 rounded-[3.125rem] px-4 py-2 lg:bg-[#1250DC]">
              <Image src={cartIcon} alt="" className="xs:size-7 size-5" />
              <p className="hidden text-center text-[0.875rem] font-semibold tracking-[0.025rem] text-white lg:block">
                Giỏ hàng
              </p>
            </button>
          </div>
        </div>
      </div>
      <div className="w-full xl:hidden">
        <SearchInput />
      </div>
    </header>
  );
};