"use client";
import cartApiRequests from "@/apiRequests/cart";
import { OrderProductCard } from "@/components/cart/OrderProductCard";
import { cn, formatPrice } from "@/lib/utils";
import { CartProductsType } from "@/types/cart";
import Image from "next/image";
import Link from "next/link";
import { useEffect, useState } from "react";
import emptyCart from "/public/empty-cart.png";

export default function page() {
  const [data, setData] = useState<CartProductsType>([]);
  const [isAvailable, setIsAvailable] = useState(true);
  console.log(isAvailable);

  useEffect(() => {
    cartApiRequests.getCartProducts().then((res) => {
      setData(res.payload.products);
      setIsAvailable(res.payload.isAvailable);
    });
  }, []);

  const getTotalPrice = () => {
    return data.reduce((acc, product) => {
      return acc + product.price * product.quantity;
    }, 0);
  };

  const getTotalPriceAfterSale = () => {
    return data.reduce((acc, product) => {
      return acc + product.priceAfterSale * product.quantity;
    }, 0);
  };
  if (data[0] === undefined) {
    return (
      <div
        className={cn(
          "relative mx-auto h-[50vh] w-[95%] max-w-[75rem] py-4 text-[#333] xs:h-[80vh] xs:py-10 xl:w-full",
        )}
      >
        <Link
          href="/"
          className={cn(
            "flex w-max flex-row items-center gap-1 text-[0.9375rem] text-[#1250DC]",
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
        "mx-auto min-h-[80vh] w-full max-w-[75rem] pb-12 pt-4 text-[#333] lg:w-[95%] xl:w-full xl:py-12",
      )}
    >
      <Link
        href="/"
        className={cn(
          "ml-[2.5%] flex w-max flex-row items-center gap-1 text-[0.9375rem] text-[#1250DC] lg:ml-0",
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
          "mt-4 flex flex-col gap-y-4 xl:flex-row xl:justify-evenly",
        )}
      >
        <div
          className={cn(
            "h-max w-full bg-white lg:rounded-[0.75rem] xl:w-[47.5rem]",
          )}
        >
          <div
            className={cn(
              "flex flex-row items-center border-b border-solid border-[#D2D5D7] px-4 pb-2 pt-3 font-medium",
            )}
          >
            <div className="ml-4 mr-auto">Sản phẩm</div>
            <div className={cn("hidden basis-[6.875rem] text-center xl:block")}>
              Giá thành
            </div>
            <div
              className={cn(
                "ml-8 mr-14 hidden basis-[6.75rem] text-center xl:block",
              )}
            >
              Số lượng
            </div>
          </div>
          <div
            className={cn(
              "divide-y p-4 [&>*]:py-4 [&>:first-child]:pt-0 [&>:last-child]:pb-0",
            )}
          >
            {data.map((cartProdcut) => (
              <OrderProductCard
                key={cartProdcut.productId}
                cartProduct={cartProdcut}
              />
            ))}
          </div>
        </div>
        <div
          className={cn(
            "h-max w-full bg-white p-3 lg:rounded-[0.75rem] xl:w-[23.375rem]",
          )}
        >
          <div
            className={cn(
              "flex cursor-pointer flex-row justify-between rounded-[0.625rem] bg-[#007AFF]/20 py-1 pl-3 pr-2",
            )}
          >
            <span className={cn("text-[0.9375rem] text-[#1250DC]")}>
              Áp dụng ưu đãi để được giảm giá
            </span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="#1250DC"
              className="size-6"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="m8.25 4.5 7.5 7.5-7.5 7.5"
              />
            </svg>
          </div>
          <div
            className={cn("mt-3 flex flex-row items-center justify-between")}
          >
            <span className={cn("text-base text-[#4a4f63]")}>Tổng tiền</span>
            <span className={cn("text-base font-medium text-[#020b27]")}>
              {formatPrice(getTotalPrice())}
            </span>
          </div>
          <div
            className={cn("mt-3 flex flex-row items-center justify-between")}
          >
            <span className={cn("text-base text-[#4a4f63]")}>
              Giảm giá trực tiếp
            </span>
            <span className={cn("text-base font-medium text-[#f79009]")}>
              -{formatPrice(getTotalPrice() - getTotalPriceAfterSale())}
            </span>
          </div>
          <div
            className={cn("mt-3 flex flex-row items-center justify-between")}
          >
            <span className={cn("text-base text-[#4a4f63]")}>
              Giảm giá voucher
            </span>
            <span className={cn("text-base font-medium text-[#f79009]")}>
              {formatPrice(0)}
            </span>
          </div>
          <div
            className={cn("mt-3 flex flex-row items-center justify-between")}
          >
            <span className={cn("text-base text-[#4a4f63]")}>
              Tiết kiệm được
            </span>
            <span className={cn("text-base font-medium text-[#f79009]")}>
              -{formatPrice(getTotalPrice() - getTotalPriceAfterSale())}
            </span>
          </div>
          <hr className="my-3" />
          <div className={cn("flex flex-col lg:flex-row xl:flex-col")}>
            <div
              className={cn(
                "mt-3 flex flex-row items-center justify-between lg:w-[32.5%] xl:w-auto",
              )}
            >
              <span
                className={cn(
                  "text-[1.125rem] font-semibold leading-6 tracking-[0.0025rem] text-[#020b27]",
                )}
              >
                Thành tiền
              </span>
              <div className={cn("flex flex-row items-baseline gap-1.5")}>
                <span
                  className={cn(
                    "text-[0.875rem] leading-[1.25rem] text-[#4a4f63] line-through",
                  )}
                >
                  {formatPrice(getTotalPrice())}
                </span>
                <span
                  className={cn(
                    "text-[1.25rem] font-semibold leading-7 tracking-[0.005rem] text-[#1250dc]",
                  )}
                >
                  {formatPrice(getTotalPriceAfterSale())}
                </span>
              </div>
            </div>
            <button
              className={cn(
                "mt-3 w-full rounded-[2.625rem] bg-[#0037c1] px-6 py-3 text-base font-medium tracking-[0.005rem] text-white active:!bg-none lg:ml-auto lg:w-[20rem] xl:ml-0 xl:w-full",
              )}
              style={{
                backgroundImage:
                  "linear-gradient(315deg, #1250dc 0%, #306de4 100%)",
              }}
            >
              Mua hàng
            </button>
          </div>
          <div
            className={cn(
              "mt-3 text-center text-[0.8125rem] leading-[1.125rem] tracking-[0.02rem]",
            )}
          >
            <span>Bằng việc tiến hành đặt mua hàng, bạn đồng ý với </span>
            <Link
              href="/dieu-khoan-dich-vu"
              className={cn("font-medium underline underline-offset-[3px]")}
            >
              Điều khoản dịch vụ
            </Link>
            <span> và </span>
            <Link
              href="/chinh-sach-xu-ly-du-lieu-ca-nhan"
              className={cn("font-medium underline underline-offset-[3px]")}
            >
              Chính sách xử lý dữ liệu cá nhân
            </Link>
            <span> của 4HProtein</span>
          </div>
        </div>
      </div>
    </div>
  );
}
