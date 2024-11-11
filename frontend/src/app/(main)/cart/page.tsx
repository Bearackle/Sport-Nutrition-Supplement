"use client";
import { cn, formatPrice } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";
import emptyCart from "/public/empty-cart.png";
import { OrderProductCard } from "@/components/cart/OrderProductCard";

const data = [{}];

export default function page() {
  const handleSelectAll = () => {
    const checkboxes = document.querySelectorAll('button[role="checkbox"]');
    const allChecked = Array.from(checkboxes).every(
      (checkbox) => checkbox.getAttribute("aria-checked") === "true",
    );

    checkboxes.forEach((checkbox) => {
      const newState = allChecked ? "false" : "true";
      checkbox.setAttribute("aria-checked", newState);
      checkbox.setAttribute(
        "data-state",
        newState === "true" ? "checked" : "unchecked",
      );

      const span = checkbox.querySelector("span");
      if (span) {
        span.setAttribute(
          "data-state",
          newState === "true" ? "checked" : "unchecked",
        );
      }
    });
  };

  const handleCheckboxClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    const target = event.target as HTMLElement;
    if (target.tagName !== "BUTTON") return;

    const currentCheckbox = target;
    const currentState =
      currentCheckbox.getAttribute("aria-checked") === "true";
    const newState = currentState ? "false" : "true";

    currentCheckbox.setAttribute("aria-checked", newState);
    currentCheckbox.setAttribute(
      "data-state",
      newState === "true" ? "checked" : "unchecked",
    );

    const span = currentCheckbox.querySelector("span");
    if (span) {
      span.setAttribute(
        "data-state",
        newState === "true" ? "checked" : "unchecked",
      );
    }

    const checkboxes = document.querySelectorAll(
      'button[role="checkbox"]:not(#select-all)',
    );
    const selectAllCheckbox = document.getElementById("select-all");

    if (!selectAllCheckbox) return;

    const allChecked = Array.from(checkboxes).every(
      (checkbox) => checkbox.getAttribute("aria-checked") === "true",
    );

    selectAllCheckbox.setAttribute(
      "aria-checked",
      allChecked ? "true" : "false",
    );
    selectAllCheckbox.setAttribute(
      "data-state",
      allChecked ? "checked" : "unchecked",
    );

    const selectAllSpan = selectAllCheckbox.querySelector("span");
    if (selectAllSpan) {
      selectAllSpan.setAttribute(
        "data-state",
        allChecked ? "checked" : "unchecked",
      );
    }
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
        "mx-auto min-h-[80vh] w-full max-w-[75rem] pb-12 pt-4 text-[#333] lg:w-[95%] xl:w-full xl:py-12",
      )}
    >
      <Link
        href="/"
        className={cn(
          "ml-[2.5%] flex flex-row items-center gap-1 text-[0.9375rem] text-[#1250DC] lg:ml-0",
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
              "flex flex-row items-center border-b border-solid border-[#D2D5D7] px-4 py-2 font-medium",
            )}
          >
            <div className={cn("mr-auto inline-flex items-center")}>
              <button
                id="select-all"
                type="button"
                role="checkbox"
                aria-checked="false"
                data-state="unchecked"
                value="on"
                onClick={handleSelectAll}
                className="peer h-5 w-5 shrink-0 rounded-full border-2 border-[#657384] focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:border-[#1250dc] data-[state=checked]:bg-[#1250dc] data-[state=checked]:text-white"
              >
                <span
                  data-state="unchecked"
                  className={cn(
                    "flex shrink-0 items-center justify-center",
                    "data-[state=unchecked]:hidden",
                  )}
                  style={{ pointerEvents: "none" }}
                >
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-3 w-3 stroke-current"
                  >
                    <path
                      d="M8.5 16.5858L4.70711 12.7929C4.31658 12.4024 3.68342 12.4024 3.29289 12.7929C2.90237 13.1834 2.90237 13.8166 3.29289 14.2071L7.79289 18.7071C8.18342 19.0976 8.81658 19.0976 9.20711 18.7071L20.2071 7.70711C20.5976 7.31658 20.5976 6.68342 20.2071 6.29289C19.8166 5.90237 19.1834 5.90237 18.7929 6.29289L8.5 16.5858Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </span>
              </button>
              <label htmlFor="select-all" className="ml-2">
                Chọn tất cả
              </label>
            </div>
            <div className={cn("hidden basis-[6.875rem] text-center xl:block")}>
              Giá thành
            </div>
            <div
              className={cn(
                "ml-4 mr-14 hidden basis-[6.75rem] text-center xl:block",
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
            <OrderProductCard handleCheckboxClick={handleCheckboxClick} />
            <OrderProductCard handleCheckboxClick={handleCheckboxClick} />
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
              {formatPrice(1000000)}
            </span>
          </div>
          <div
            className={cn("mt-3 flex flex-row items-center justify-between")}
          >
            <span className={cn("text-base text-[#4a4f63]")}>
              Giảm giá trực tiếp
            </span>
            <span className={cn("text-base font-medium text-[#f79009]")}>
              -{formatPrice(200000)}
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
              -{formatPrice(200000)}
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
                  {formatPrice(1000000)}
                </span>
                <span
                  className={cn(
                    "text-[1.25rem] font-semibold leading-7 tracking-[0.005rem] text-[#1250dc]",
                  )}
                >
                  {formatPrice(800000)}
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
