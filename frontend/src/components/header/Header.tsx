import { nunito } from "@/lib/font";
import { cn } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
import SearchInput from "./SearchInput";
import accountIcon from "/public/account-icon.webp";
import addressIcon from "/public/address-icon.webp";
import cartIcon from "/public/cart-icon.webp";
import logo from "/public/logo.png";
import phoneIcon from "/public/phone-icon.webp";

export const Header = () => {
  return (
    <header
      style={{
        background:
          "linear-gradient(180deg, rgba(63,133,233,1) 0%, rgba(48,116,225,1) 50%, rgba(37,105,222,1) 100%)",
        backgroundColor: "rgb(63, 133, 233)",
      }}
    >
      <div className="mx-auto flex max-w-[75rem] flex-row items-center gap-6 py-2">
        <Link href="/" className="flex flex-row items-center gap-2">
          <Image src={logo} alt="logo" className="size-[4rem]" />
          <p
            className={cn(
              nunito.className,
              "max-w-[12.5rem] text-center text-[0.6rem] font-extrabold uppercase !italic text-white",
            )}
          >
            Thực phẩm dinh dưỡng thể thao sport nutrition supplement
          </p>
        </Link>
        <SearchInput />
        <div className="flex flex-row items-center gap-2">
          <Image src={phoneIcon} alt="" className="size-[1.75rem]" />
          <div className="text-center text-[0.75rem] text-white">
            <p>Gọi mua hàng</p>
            <Link
              href="tel:0333303802"
              className="font-bold -tracking-[0.05rem]"
            >
              033 330 3802
            </Link>
          </div>
        </div>
        <div className="flex flex-row items-center gap-2">
          <Image src={addressIcon} alt="" className="size-[1.75rem]" />
          <p className="text-center text-[0.75rem] text-white">
            Hệ thống cửa hàng
          </p>
        </div>
        <Link href="login" className="flex flex-row items-center gap-2">
          <Image src={accountIcon} alt="" className="size-[1.75rem]" />
          <p className="text-center text-[0.75rem] font-semibold text-white">
            Đăng nhập
          </p>
        </Link>
        <div className="">
          <button className="flex flex-row items-center gap-2 rounded-[0.625rem] border-[0.1rem] border-solid border-white px-3 py-2">
            <Image src={cartIcon} alt="" className="size-[1.75rem]" />
            <p className="text-center text-[0.875rem] font-semibold text-white">
              Giỏ hàng
            </p>
          </button>
        </div>
      </div>
    </header>
  );
};
