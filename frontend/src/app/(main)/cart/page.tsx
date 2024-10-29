import { cn } from "@/lib/utils";
import Link from "next/link";
import Image from "next/image";
import emptyCart from "/public/empty-cart.png";

const data = [{}];

export default function page() {
  if (data[0]) {
    return (
      <div
        className={cn(
          "relative mx-auto h-[50vh] w-[95%] max-w-[75rem] py-4 text-[#333] xs:h-[80vh] xs:py-10 xl:w-full",
        )}
      >
        <Link
          href="/"
          className={cn(
            "flex flex-row items-center gap-1 text-[0.9375rem] text-[#1250DC]",
          )}
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth={1.5}
            stroke="#1250DC"
            className="size-5"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z"
            />
          </svg>
          Tiếp tục mua sắm
        </Link>
        <div
          className={cn(
            "absolute left-1/2 top-1/2 flex w-max max-w-[80%] -translate-x-1/2 -translate-y-1/2 flex-col items-center",
          )}
        >
          <h2
            className={cn(
              "text-center text-[1.25rem] font-bold text-[#4a4f63]",
            )}
          >
            Bạn chưa có sản phẩm nào trong giỏ hàng
          </h2>
          <Image
            src={emptyCart}
            alt="Empty cart"
            width={512}
            height={512}
            className={cn("size-56")}
          />
        </div>
      </div>
    );
  }
  return (
    <div
      className={cn(
        "mx-auto min-h-[80vh] w-[95%] max-w-[75rem] py-12 text-[#333] xl:w-full",
      )}
    >
      <Link
        href="/"
        className={cn(
          "flex flex-row items-center gap-1 text-[0.9375rem] text-[#1250DC]",
        )}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          strokeWidth={1.5}
          stroke="#1250DC"
          className="size-5"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z"
          />
        </svg>
        Tiếp tục mua sắm
      </Link>
      <div className={cn("mt-4 flex flex-row justify-evenly")}>
        <div className={cn("w-[47.5rem] rounded-[0.75rem] bg-white p-6")}></div>
        <div
          className={cn("w-[23.375rem] rounded-[0.75rem] bg-white p-6")}
        ></div>
      </div>
    </div>
  );
}
