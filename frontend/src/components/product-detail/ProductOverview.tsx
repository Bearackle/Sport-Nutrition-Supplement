"use client";
import { cn, formatPrice } from "@/lib/utils";
import { Rating } from "@mui/material";
import Link from "next/link";
import Image from "next/image";
import giftIcon from "/public/gift-icon.svg";
import { useEffect, useState } from "react";
import { CustomCarousel } from "@/components/common/CustomCarousel";
import { CarouselItem } from "@/components/ui/carousel";

type TProps = {
  id: string;
  image: string[];
  name: string;
  brand: {
    id: string;
    name: string;
  };
  rating: number;
  price: number;
  priceAfterDiscount: number;
  discount: number;
  promotionInformation: string[];
  variants: {
    id: string;
    name: string;
    stockQuantity: number;
  }[];
  shortDescription: string[];
};

export const ProductOverview = ({
  id,
  image,
  name,
  brand,
  rating,
  price,
  priceAfterDiscount,
  discount,
  promotionInformation,
  variants,
  shortDescription,
}: TProps) => {
  const [quantity, setQuantity] = useState(1);
  const [currentVariant, setCurrentVariant] = useState(variants[0]);

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

  console.log(document.querySelector('input[name="variant"]:checked'));
  return (
    <div
      id={id}
      className={cn(
        "mx-auto mt-4 flex w-[95%] flex-col justify-between gap-y-6 overflow-hidden rounded-[0.75rem] bg-white p-8",
        "lg:flex-row",
      )}
    >
      {/*Product Image*/}
      <div className={cn("flex w-full justify-center lg:w-[22.5rem]")}>
        <div
          className={cn(
            "aspect-square w-full overflow-hidden rounded-[0.625rem] border border-solid border-[#333]/30 px-[10%] xs:size-[22.5rem]",
          )}
        >
          <CustomCarousel dotVisible={true}>
            {image.map((img, index) => (
              <CarouselItem
                key={index}
                className="flex h-[75vw] w-full basis-full items-center justify-center xs:h-[21.5rem]"
              >
                <Image
                  src={img}
                  alt={`Product image ${index}`}
                  width={360}
                  height={360}
                  className={cn(
                    "h-auto w-auto",
                    "max-h-[70%] max-w-full xs:max-h-[20rem] xs:max-w-[20rem]",
                  )}
                />
              </CarouselItem>
            ))}
          </CustomCarousel>
        </div>
      </div>

      {/*Product Information*/}
      <div
        className={cn("w-full overflow-hidden lg:w-[32.5rem] xl:w-[42.5rem]")}
      >
        <h2 className={cn("text-2xl leading-[1.21]")}>{name}</h2>
        <div className={cn("flex flex-row items-center gap-2")}>
          <span className={cn("text-[0.875rem]")}>{rating}</span>
          <Rating name="read-only" value={rating} readOnly size="small" />
          <span className={cn("text-[0.875rem] text-[#8C8F8D]")}>(48)</span>
        </div>
        <div
          className={cn(
            "mt-1 flex flex-row gap-2 text-[0.875rem] leading-[1.21]",
          )}
        >
          <div>
            <span>Thương hiệu: </span>
            <Link href={"#"} className={cn("text-[#1250DC]")}>
              {brand.name}
            </Link>
          </div>
          <div>
            <span>HEX: </span>
            <Link href={"#"} className={cn("text-[#1250DC]")}>
              859400007993
            </Link>
          </div>
        </div>
        <div
          className={cn(
            "mt-1 flex flex-row items-center gap-3 text-[0.875rem] leading-[1.21]",
          )}
        >
          <span
            className={cn("text-4xl font-bold leading-[1.21] text-[#1250DC]")}
          >
            {formatPrice(priceAfterDiscount)}
          </span>
          <div
            className={cn(
              "size-max rounded-[0.625rem] bg-[#8C8F8D]/[0.15] px-2 py-[0.375rem] text-[0.875rem] leading-[1.21]",
            )}
          >
            -{discount}%
          </div>
          <span
            className={cn(
              "text-[1.25rem] font-bold leading-[1.21] text-[#8C8F8D] line-through",
            )}
          >
            {formatPrice(price)}
          </span>
        </div>
        <p className={cn("text-base leading-[1.21]")}>
          (Tiết kiệm{" "}
          <span className="text-[#1F5ADD]">
            {formatPrice(price - priceAfterDiscount)}
          </span>
          )
        </p>

        {/*Promotional Information*/}
        <div
          className={cn(
            "mt-5 w-max max-w-[95%] rounded-[0.625rem] bg-[#EDF0F3] p-3",
          )}
        >
          <div
            className={cn(
              "flex w-max flex-row items-center gap-2 rounded-[0.125rem] bg-[#1250DC] px-[0.375rem] py-[0.1875rem]",
            )}
          >
            <Image
              src={giftIcon}
              alt="gift"
              width={20}
              height={20}
              className="size-5"
            />
            <span
              className={cn(
                "text-[0.875rem] font-bold uppercase leading-[1.5] text-white",
              )}
            >
              Thông tin ưu đãi
            </span>
          </div>
          <div
            className={cn(
              "mt-[0.375rem] rounded-[0.625rem] bg-white px-3 py-2",
            )}
          >
            <ul
              className={cn(
                "list-disc space-y-1 pl-4 text-[0.875rem] leading-[1.21]",
              )}
            >
              {promotionInformation.map((item, index) => (
                <li key={`promotion-info-${index}`}>{item}</li>
              ))}
            </ul>
          </div>
        </div>

        {/*Variants*/}
        <div className={cn("mt-2 flex w-max max-w-[95%] flex-row gap-2")}>
          <div
            className={cn(
              "w-[4rem] shrink-0 pt-[0.375rem] text-[1.125rem] font-bold leading-[1.21]",
            )}
          >
            Mùi vị:
          </div>
          <div className={cn("flex flex-wrap gap-2")}>
            {variants.map((variant, index) => (
              <div key={variant.id}>
                <input
                  id={variant.id}
                  name="variant"
                  type="radio"
                  value={variant.id}
                  defaultChecked={index === 0}
                  onClick={() => setCurrentVariant(variant)}
                  className={cn("hidden")}
                />
                <label
                  htmlFor={variant.id}
                  className={cn(
                    "inline-flex cursor-pointer flex-row items-center justify-center rounded-[1.25rem] border border-solid px-3 py-2 text-[0.875rem] font-bold leading-[1.21] transition-all duration-100",
                    currentVariant.id === variant.id
                      ? "border-[#1F5ADD] bg-[#1F5ADD]/10 text-[#1F5ADD]"
                      : "border-[#8C8F8D] text-[#8C8F8D]",
                  )}
                >
                  {variant.name}
                </label>
              </div>
            ))}
          </div>
        </div>

        {/*Short Infomation*/}
        <div className={cn("mt-3 text-[0.875rem] leading-[1.21] text-[#333]")}>
          <p>{name}</p>
          <ul
            className={cn(
              "mt-3 list-disc space-y-1 pl-6 text-[0.875rem] leading-[1.21]",
            )}
          >
            {shortDescription.map((item, index) => (
              <li key={`product-short-info-${index}`}>{item}</li>
            ))}
          </ul>
        </div>

        {/*Quantity*/}
        <div
          className={cn("mt-4 flex flex-row items-center gap-4 text-[#333]")}
        >
          <p className={cn("text-[1.125rem] font-normal leading-[1.21]")}>
            Số lượng:
          </p>
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
          <p
            className={cn(
              "text-[0.875rem] font-normal leading-[1.21] text-[#8C8F8D]",
            )}
          >{`Tồn kho: ${currentVariant.stockQuantity}`}</p>
        </div>

        {/*Add to Cart*/}
        <div
          className={cn(
            "mt-4 flex flex-col items-center gap-x-7 gap-y-3 xs:flex-row",
          )}
        >
          <button
            className={cn(
              "w-full rounded-[1.25rem] bg-[#1F5ADD] px-10 py-3 text-base font-bold leading-[1.21] text-white xs:w-auto",
            )}
          >
            Chọn mua
          </button>
          <button
            className={cn(
              "w-full rounded-[1.25rem] bg-[#004FFF]/[0.23] px-5 py-3 text-base font-bold leading-[1.21] text-[#1F5ADD] xs:w-auto",
            )}
          >
            Thêm vào giỏ hàng
          </button>
        </div>

        <p className={cn("mt-6")}>
          Gọi đặt mua:{" "}
          <strong>
            <Link href="tel:0333303802">033.330.3802</Link>
          </strong>{" "}
          (9:00 - 20:00)
        </p>
      </div>
    </div>
  );
};
