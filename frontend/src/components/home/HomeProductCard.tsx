"use client";
import { cn, convertSlugUrl, formatPrice } from "@/lib/utils";
import { Rating } from "@mui/material";
import Image from "next/image";
import Link from "next/link";
import { useRouter } from "next/navigation";
import blueCheck from "/public/blue-check.svg";

type TProps = {
  index: number;
  product: {
    productId: number;
    productName: string;
    image: {
      imageId: number;
      imageUrl: string;
      publicId: string;
      createAt: string;
    }[];
    price: number;
    sale: number;
    priceAfterSale: number;
  };
};

const HomeProductCard = ({ index, product }: TProps) => {
  const router = useRouter();
  return (
    <div
      id={product?.productId.toString()}
      className="group mx-auto w-[13.5rem] space-y-1 overflow-hidden rounded-[0.625rem] border border-solid border-[#8C8F8D] bg-white px-4 py-3"
    >
      <div>
        <Image
          src={product?.image[0].imageUrl}
          alt={product?.productName}
          width={145}
          height={145}
          className="mx-auto h-[9.0625rem] w-auto"
        />
      </div>
      <div>
        <Link
          href={`/san-pham/${convertSlugUrl(product?.productName)}-${product?.productId}.html`}
          className="space-y-1"
        >
          <div
            className={cn(
              "flex flex-row items-center gap-2 text-[0.6rem] font-bold uppercase leading-none !no-underline ml:text-[0.625rem]",
              index === 0 ? "opacity-100" : "opacity-0",
            )}
          >
            <div className="flex h-6 items-center justify-center rounded-full bg-[#C116164D] px-1 text-[#C11616]">
              🔥 TOP DEAL
            </div>
            <div className="flex h-6 w-fit flex-row items-center rounded-full bg-[#3498DB4D] px-1 text-[#043BFF]">
              <Image src={blueCheck} alt="" className="size-4" />
              Chính hãng
            </div>
          </div>
          <div className="line-clamp-3 min-h-[3.9875rem] text-[0.875rem] font-normal leading-normal text-[#333] group-hover:underline">
            {product?.productName}
          </div>
        </Link>
      </div>
      <Rating name="read-only" value={5} readOnly />
      <p className="text-normal font-bold leading-[1.21] text-[#C11616]">
        {formatPrice(product?.priceAfterSale)}
      </p>
      <div className="flex flex-row items-center gap-1">
        <p className="text-[0.75rem] font-bold leading-[1.21] text-[#8C8F8D] line-through">
          {formatPrice(product?.price)}
        </p>
        <div className="rounded-full bg-[#C11616] p-1 text-[0.625rem] font-bold text-white">{`-${product?.sale}%`}</div>
      </div>
      <button
        onClick={() =>
          router.push(
            `/san-pham/${convertSlugUrl(product?.productName)}-${product?.productId}.html`,
          )
        }
        className="text-normal w-full rounded-full bg-[#1F5ADD] py-3 leading-[1.21] text-white transition-all duration-300 hover:bg-[#2c6af0]"
      >
        Chọn mua
      </button>
    </div>
  );
};

export default HomeProductCard;
