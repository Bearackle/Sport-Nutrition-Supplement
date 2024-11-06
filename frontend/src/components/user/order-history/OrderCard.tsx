"use client";
import { formatPrice, getVietnameseDate, getVietnameseTime } from "@/lib/utils";
import { TParamsOrder } from "@/types/order-history";
import Image from "next/image";
import { useState } from "react";

type TProps = {
  order: TParamsOrder;
};

const OrderCard = ({ order }: TProps) => {
  const [showAll, setShowAll] = useState(false);
  return (
    <div className="flex w-full flex-col items-start justify-between py-[1em] text-[#333] md:flex-row">
      <div className="flex w-full shrink-0 flex-col gap-[1em] md:w-auto md:basis-[27.5em]">
        {order.products
          .slice(0, showAll ? order.products.length : 1)
          .map((product, index) => (
            <div key={index} className="flex flex-row items-center">
              <div className="flex size-[3.5em] items-center justify-center rounded-[0.375em] border border-solid">
                <Image
                  src={product.productImage}
                  alt={product.productName}
                  width={48}
                  height={48}
                  className="size-auto max-h-[3em] max-w-[3em]"
                />
              </div>
              <div className="ml-[0.5em] grow">
                <p className="line-clamp-1 text-[0.9375em] leading-[1.3]">
                  {product.productName}
                </p>
                <p className="line-clamp-1 text-[0.875em] leading-[1.3]">
                  {product.variant}
                </p>
                <p className="overflow-hidden text-[0.8em] leading-[1.3]">
                  SL: {product.quantity}
                </p>
              </div>
            </div>
          ))}
        {!showAll && (
          <button
            onClick={() => setShowAll(!showAll)}
            className="flex flex-row items-center justify-center gap-[0.125em] text-[0.8em] text-[#707070]"
          >
            Xem thêm{" "}
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 22"
              strokeWidth={1.5}
              stroke="#707070"
              className="size-[1em]"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="m19.5 8.25-7.5 7.5-7.5-7.5"
              />
            </svg>
          </button>
        )}
      </div>
      <div className="w-full shrink-0 text-center md:w-auto md:basis-[7em]">
        <div className="text-[0.9375em]">
          {getVietnameseDate(order.orderDate)}
        </div>
        <div className="text-[0.875em]">
          {getVietnameseTime(order.orderDate)}
        </div>
      </div>
      <div className="w-full shrink-0 text-center md:w-auto md:basis-[6.875em]">
        {formatPrice(order.totalAmount)}
      </div>
      <div className="w-full shrink-0 text-center text-[0.9375em] md:w-auto md:basis-[8em]">
        {order.status}
      </div>
    </div>
  );
};

export default OrderCard;
