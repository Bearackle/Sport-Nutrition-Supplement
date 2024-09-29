import { nunito } from "@/lib/font";
import { cn } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
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
      style={{
        background:
          "linear-gradient(180deg, rgba(63,133,233,1) 0%, rgba(48,116,225,1) 50%, rgba(37,105,222,1) 100%)",
      }}
    >
      <div className="relative mx-auto flex h-[6.75rem] max-w-[75rem] flex-row items-center justify-between px-8 py-2">
        <div className="absolute right-8 top-3 flex flex-row items-center gap-1">
          <Image src={phoneIcon} alt="phone" className="size-4" />
          <p className="text-center text-[0.75rem] font-semibold text-white">
            Tel: 033 330 3802
          </p>
        </div>
        <Link href="/" className="flex flex-row items-center" title="4H Store">
          <Image src={logo} alt="logo" className="size-[5rem]" />
          <p
            className={cn(
              nunito.className,
              "max-w-[15rem] text-center text-[0.7rem] font-extrabold uppercase text-white",
            )}
          >
            Thực phẩm dinh dưỡng thể thao sport nutrition supplement
          </p>
        </Link>
        <div className={cn("relative w-fit", nunito.className)}>
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
        <Link href="login" className="flex flex-row items-center gap-2">
          <Image src={accountIcon} alt="" className="size-[1.75rem]" />
          <p className="text-center text-[0.875rem] font-semibold text-white">
            Đăng nhập
          </p>
        </Link>
        <div>
          <button className="flex flex-row items-center gap-2 rounded-[3.125rem] bg-[#1250DC] px-4 py-2">
            <Image src={cartIcon} alt="" className="size-[1.75rem]" />
            <p className="text-center text-[0.875rem] font-semibold tracking-[0.025rem] text-white">
              Giỏ hàng
            </p>
          </button>
        </div>
      </div>
    </header>
  );
};
