import Image from "next/image";
import Link from "next/link";
import logo from "../../public/logo.png";
import phoneIcon from "../../public/phone-icon.webp";
import addressIcon from "../../public/address-icon.webp";
import accountIcon from "../../public/account-icon.webp";
import cartIcon from "../../public/cart-icon.webp";
import { cn } from "@/lib/utils";
import { nunito } from "@/lib/font";

export const Navbar = () => {
  return (
    <nav className="bg-[#066196]">
      <div className="max-w-[75rem] mx-auto">
        <ul className="py-2 flex flex-row items-center gap-6">
          <li>
            <Link href="/" className="flex flex-row gap-2 items-center">
              <Image src={logo} alt="logo" className="size-[6rem]" />
              <p
                className={cn(
                  nunito.className,
                  "max-w-[12.5rem] uppercase text-[0.65rem] text-white font-extrabold !italic"
                )}
              >
                Thực phẩm dinh dưỡng thể thao sport nutrition supplement
              </p>
            </Link>
          </li>
          <li>
            <input
              type="text"
              placeholder="Nhập tên sản phẩm.."
              className="w-[15rem] text-[0.875rem] px-4 py-2 rounded-[0.375rem] focus:outline-none"
            />
          </li>
          <li className="flex flex-row items-center gap-2">
            <Image src={phoneIcon} alt="" className="size-[1.75rem]" />
            <div className="text-[0.875rem] text-white text-center">
              <p>Gọi mua hàng</p>
              <Link
                href="tel:0333303802"
                className="font-bold -tracking-[0.05rem]"
              >
                033 330 3802
              </Link>
            </div>
          </li>
          <li className="flex flex-row items-center gap-2">
            <Image src={addressIcon} alt="" className="size-[1.75rem]" />
            <p className="text-[0.875rem] text-white text-center">
              Hệ thống cửa hàng
            </p>
          </li>
          <li className="flex flex-row items-center gap-2 cursor-pointer">
            <Image src={accountIcon} alt="" className="size-[1.75rem]" />
            <p className="text-[0.875rem] text-white text-center font-semibold">
              Đăng nhập
            </p>
          </li>
          <li className="">
            <button className="flex flex-row items-center gap-2 border-[0.1rem] border-solid border-white px-3 py-2 rounded-[0.625rem]">
              <Image src={cartIcon} alt="" className="size-[1.75rem]" />
              <p className="text-[0.875rem] text-white text-center font-semibold">
                Giỏ hàng
              </p>
            </button>
          </li>
        </ul>
      </div>
    </nav>
  );
};
