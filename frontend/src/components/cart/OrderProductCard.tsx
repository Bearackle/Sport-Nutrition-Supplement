"use client";
import { cn, formatPrice } from "@/lib/utils";
import Link from "next/link";
import Image from "next/image";
import React, { useEffect, useState } from "react";

type TProps = {
  handleCheckboxClick: (e: React.MouseEvent<HTMLButtonElement>) => void;
};

export const OrderProductCard = ({ handleCheckboxClick }: TProps) => {
  const [quantity, setQuantity] = useState(1);

  const handleMinusButton = () => {
    if (quantity === 1) return;
    setQuantity(quantity - 1);
  };

  const handlePlusButton = () => {
    if (quantity === 999) return;
    setQuantity(quantity + 1);
  };

  useEffect(() => {
    if (quantity < 1) {
      setQuantity(1);
    } else if (quantity > 999) {
      setQuantity(999);
    }
  }, [quantity]);
  return (
    <div className={cn("flex items-center")}>
      <div
        className={cn(
          "relative mr-2 mt-[2.1875rem] flex shrink-0 items-center justify-center self-start p-0.5",
        )}
      >
        <button
          type="button"
          role="checkbox"
          aria-checked="false"
          data-state="unchecked"
          value="on"
          onClick={(event) => handleCheckboxClick(event)}
          className="peer h-5 w-5 shrink-0 rounded-full border-2 border-[#657384] focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:border-[#1250dc] data-[state=checked]:bg-[#1250dc] data-[state=checked]:text-white"
        >
          <span
            data-state="unchecked"
            className={cn(
              "flex shrink-0 items-center justify-center",
              "data-[state=unchecked]:opacity-0",
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
      </div>
      <Link
        href={`product/1`}
        className={cn(
          "boder-solid mr-3 shrink-0 self-start rounded-lg border p-1.5",
        )}
      >
        <Image
          src={
            "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887"
          }
          alt={"Product image"}
          width={80}
          height={80}
          loading="lazy"
          decoding="async"
          data-nimg="1"
          className={cn("max-h-20 max-w-20 object-contain")}
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
            href={`product/1`}
            className={cn("line-clamp-3 text-[0.9375rem] leading-[1.21]")}
          >
            Nutrex Plant Protein - Protein Thực Vật (1.2 LBS) Nutrex Plant
            Protein - Protein Thực Vật (1.2 LBS) Nutrex Plant Protein - Protein
            Thực Vật (1.2 LBS) Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)
            Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)
          </Link>
          <span
            className={cn(
              "line-clamp-1 text-[0.875rem] font-normal leading-[1.21] text-[#657384]",
            )}
          >
            CINNAMO COOKIES
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
            {formatPrice(1579000 * quantity)}
          </span>
          <span
            className={cn(
              "text-[.875rem] font-medium leading-[1.21] text-[#657384] line-through",
            )}
          >
            {formatPrice(1973750 * quantity)}
          </span>
        </div>
        <div className={cn("shrink-0 lg:ml-4 lg:mr-6")}>
          <div
            className={cn(
              "flex h-[1.875rem] flex-row rounded-full border border-solid border-[#D2D5D7]",
            )}
          >
            <button
              disabled={quantity === 1}
              onClick={handleMinusButton}
              className={cn(
                "flex h-full items-center px-1",
                quantity === 1 && "opacity-50",
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
            <input
              type="number"
              min="1"
              max="999"
              value={quantity}
              onChange={(e) => setQuantity(Number(e.target.value))}
              className={cn(
                "h-full w-10 border-x border-solid border-[#D2D5D7] text-center text-[0.9375rem] leading-[1.21] [appearance:textfield] focus:outline-none",
              )}
            />
            <button
              disabled={quantity === 999}
              onClick={handlePlusButton}
              className={cn(
                "flex h-full items-center px-1",
                quantity === 999 && "opacity-50",
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
        </div>
      </div>
      <div
        className={cn(
          "relative ml-3 mt-[1.5rem] flex shrink-0 items-center justify-center self-start p-0.5 md:ml-4",
        )}
      >
        <button
          type="button"
          aria-haspopup="dialog"
          aria-expanded="false"
          aria-controls="radix-:r2:"
          data-state="closed"
          className="text-gray-6 [&amp;:not(:disabled)]:hover:opacity-75 [&amp;:not(:disabled)]:active:opacity-100 h-10 shrink-0 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            className="h-[18px] w-[18px]"
          >
            <path
              d="M2.91602 7.03125L4.16144 22.0657C4.25069 23.1499 5.17422 24 6.26256 24H17.7378C18.8261 24 19.7497 23.1499 19.8389 22.0657L21.0843 7.03125H2.91602ZM8.48387 21.1875C8.11581 21.1875 7.80616 20.9012 7.78281 20.5283L7.07969 9.18455C7.05564 8.79661 7.3502 8.46291 7.73748 8.43886C8.13916 8.41069 8.45847 8.70872 8.48317 9.09666L9.1863 20.4404C9.21119 20.8421 8.89333 21.1875 8.48387 21.1875ZM12.7033 20.4844C12.7033 20.873 12.3888 21.1875 12.0002 21.1875C11.6115 21.1875 11.297 20.873 11.297 20.4844V9.14062C11.297 8.75198 11.6115 8.4375 12.0002 8.4375C12.3888 8.4375 12.7033 8.75198 12.7033 9.14062V20.4844ZM16.9206 9.18459L16.2175 20.5283C16.1944 20.8974 15.8867 21.205 15.4718 21.1861C15.0845 21.1621 14.79 20.8284 14.814 20.4405L15.5171 9.0967C15.5412 8.70877 15.8811 8.42653 16.2628 8.43891C16.6501 8.46295 16.9447 8.79666 16.9206 9.18459Z"
              fill="currentColor"
            ></path>
            <path
              d="M21.1406 2.8125H16.9219V2.10938C16.9219 0.946219 15.9757 0 14.8125 0H9.1875C8.02434 0 7.07812 0.946219 7.07812 2.10938V2.8125H2.85938C2.0827 2.8125 1.45312 3.44208 1.45312 4.21875C1.45312 4.99533 2.0827 5.625 2.85938 5.625C9.32653 5.625 14.6737 5.625 21.1406 5.625C21.9173 5.625 22.5469 4.99533 22.5469 4.21875C22.5469 3.44208 21.9173 2.8125 21.1406 2.8125ZM15.5156 2.8125H8.48438V2.10938C8.48438 1.72144 8.79956 1.40625 9.1875 1.40625H14.8125C15.2004 1.40625 15.5156 1.72144 15.5156 2.10938V2.8125Z"
              fill="currentColor"
            ></path>
          </svg>
        </button>
      </div>
    </div>
  );
};
