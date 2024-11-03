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
    <div className="flex w-full flex-row items-start justify-between py-4 text-[#333]">
      <div className="flex shrink-0 basis-[27.5rem] flex-col gap-4">
        {order.products
          .slice(0, showAll ? order.products.length : 1)
          .map((product, index) => (
            <div key={index} className="flex flex-row items-center">
              <div className="flex size-14 items-center justify-center rounded-[0.375rem] border border-solid">
                <Image
                  src={product.productImage}
                  alt={product.productName}
                  width={48}
                  height={48}
                  className="size-auto max-h-12 max-w-12"
                />
              </div>
              <div className="ml-2 grow">
                <p className="line-clamp-1 text-[0.9375rem] leading-[1.3]">
                  {product.productName}
                </p>
                <p className="line-clamp-1 text-[0.875rem] leading-[1.3]">
                  {product.variant}
                </p>
                <p className="overflow-hidden text-[0.8rem] leading-[1.3]">
                  SL: {product.quantity}
                </p>
              </div>
            </div>
          ))}
        {!showAll && (
          <button
            onClick={() => setShowAll(!showAll)}
            className="flex flex-row items-center justify-center gap-0.5 text-[0.8rem] text-[#707070]"
          >
            Xem thêm{" "}
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 22"
              strokeWidth={1.5}
              stroke="#707070"
              className="size-4"
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
      <div className="shrink-0 basis-[7rem] text-center">
        <div className="text-[0.9375rem]">
          {getVietnameseDate(order.orderDate)}
        </div>
        <div className="text-[0.875rem]">
          {getVietnameseTime(order.orderDate)}
        </div>
      </div>
      <div className="shrink-0 basis-[6.875rem] text-center">
        {formatPrice(order.totalAmount)}
      </div>
      <div className="shrink-0 basis-[8rem] text-center text-[0.9375rem]">
        {order.status}
      </div>
    </div>
  );
};

export default OrderCard;
