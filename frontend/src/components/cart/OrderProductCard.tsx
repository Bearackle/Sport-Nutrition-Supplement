"use client";
import cartApiRequests from "@/apiRequests/cart";
import { cn, formatPrice, handleErrorApi } from "@/lib/utils";
import { CartProductType } from "@/types/cart";
import Image from "next/image";
import Link from "next/link";
import { RemoveProductDialog } from "./RemoveProductDialog";

type TProps = {
  cartProduct: CartProductType;
};

export const OrderProductCard = ({ cartProduct }: TProps) => {
  const handleMinusButton = async () => {
    if (cartProduct.quantity === 1) return;
    try {
      await cartApiRequests.updateProductQuantity(
        cartProduct.cartItemId,
        cartProduct.quantity - 1,
      );
    } catch (error) {
      handleErrorApi({ error });
    } finally {
      location.reload();
    }
  };

  const handlePlusButton = async () => {
    if (
      cartProduct.quantity === cartProduct.stockQuantity ||
      cartProduct.quantity === 999
    )
      return;
    try {
      await cartApiRequests.updateProductQuantity(
        cartProduct.cartItemId,
        cartProduct.quantity + 1,
      );
    } catch (error) {
      handleErrorApi({ error });
    } finally {
      location.reload();
    }
  };
  return (
    <div className={cn("flex items-center")}>
      <Link
        href={`san-pham/${cartProduct.productId}`}
        className={cn(
          "mr-3 shrink-0 self-start rounded-lg border border-solid",
        )}
      >
        <Image
          src={cartProduct.image}
          alt={cartProduct.productName}
          width={80}
          height={80}
          loading="lazy"
          decoding="async"
          data-nimg="1"
          className={cn("max-h-20 max-w-20 rounded-[0.4375rem] object-contain")}
        />
      </Link>
      <div
        className={cn(
          "flex flex-wrap items-center justify-between md:flex-auto",
        )}
      >
        <div
          className={cn(
            "flex shrink-0 basis-full flex-col gap-y-1 md:basis-[17.5rem]",
          )}
        >
          <Link
            href={`/san-pham/${cartProduct.productId}`}
            className={cn("line-clamp-3 text-[0.9375rem] leading-[1.21]")}
          >
            {cartProduct.productName}
          </Link>
          <span
            className={cn(
              "line-clamp-1 text-[0.875rem] font-normal leading-[1.21] text-[#657384]",
            )}
          >
            {cartProduct.variantName}
          </span>
        </div>
        <div
          className={cn(
            "flex flex-wrap items-baseline gap-x-2 md:flex-col lg:ml-4 lg:items-end lg:text-right",
          )}
        >
          <span
            className={cn(
              "text-base font-semibold leading-[1.21] text-[#1250dc]",
            )}
          >
            {formatPrice(cartProduct.priceAfterSale * cartProduct.quantity)}
          </span>
          <span
            className={cn(
              "text-[.875rem] font-medium leading-[1.21] text-[#657384] line-through",
            )}
          >
            {formatPrice(cartProduct.price * cartProduct.quantity)}
          </span>
        </div>
        <div className={cn("shrink-0 lg:ml-4 lg:mr-6")}>
          {cartProduct.stockQuantity === 0 ? (
            <div className="text-base text-[#657384]">Hết hàng</div>
          ) : (
            <div
              className={cn(
                "flex h-[1.875rem] flex-row rounded-full border border-solid border-[#D2D5D7]",
              )}
            >
              <button
                disabled={cartProduct.quantity === 1}
                onClick={handleMinusButton}
                className={cn(
                  "flex h-full items-center px-1",
                  cartProduct.quantity === 1 && "opacity-50",
                )}
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  strokeWidth={1.5}
                  stroke="black"
                  className="size-5"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M5 12h14"
                  />
                </svg>
              </button>
              <div
                className={cn(
                  "flex h-full w-10 select-none items-center justify-center border-x border-solid border-[#D2D5D7] text-[0.9375rem] leading-[1.21] [appearance:textfield] focus:outline-none",
                )}
              >
                {cartProduct.quantity}
              </div>
              <button
                disabled={
                  cartProduct.quantity === cartProduct.stockQuantity ||
                  cartProduct.quantity === 999
                }
                onClick={handlePlusButton}
                className={cn(
                  "flex h-full items-center px-1",
                  (cartProduct.quantity === cartProduct.stockQuantity ||
                    cartProduct.quantity === 999) &&
                    "opacity-50",
                )}
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  strokeWidth={1.5}
                  stroke="black"
                  className="size-5"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15"
                  />
                </svg>
              </button>
            </div>
          )}
        </div>
      </div>
      <div
        className={cn(
          "relative ml-3 flex shrink-0 items-center justify-center p-0.5 md:ml-4",
        )}
      >
        <RemoveProductDialog cartItemId={cartProduct.cartItemId} />
      </div>
    </div>
  );
};
