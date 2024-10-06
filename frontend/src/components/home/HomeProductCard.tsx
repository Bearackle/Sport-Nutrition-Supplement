import { cn, formatPrice } from "@/lib/utils";
import { Rating } from "@mui/material";
import Image from "next/image";
import Link from "next/link";
import blueCheck from "/public/blue-check.svg";

type TProps = {
  index: number;
  id: number;
  image: string;
  name: string;
  rating: number;
  price: number;
  discount: number;
  priceAfterDiscount: number;
};

const HomeProductCard = ({
  index,
  id,
  image,
  name,
  rating,
  price,
  discount,
  priceAfterDiscount,
}: TProps) => {
  return (
    <div className="group mx-auto w-[13.5rem] space-y-1 overflow-hidden rounded-[0.625rem] border border-solid border-[#8C8F8D] bg-white px-4 py-3">
      <div>
        <Image
          src={image}
          alt={name}
          width={145}
          height={145}
          className="mx-auto h-[9.0625rem] w-auto"
        />
      </div>
      <div>
        <Link href={"#"} className="space-y-1">
          <div
            className={cn(
              "flex flex-row items-center gap-2 text-[0.6rem] font-bold uppercase !no-underline ml:text-[0.625rem]",
              index === 0 ? "opacity-100" : "opacity-0",
            )}
          >
            <div className="rounded-full bg-[#C116164D] p-1 text-[#C11616]">
              <span>🔥</span> TOP DEAL
            </div>
            <div className="flex w-fit flex-row items-center rounded-full bg-[#3498DB4D] p-1 text-[#043BFF]">
              <Image src={blueCheck} alt="" className="size-4" />
              Chính hãng
            </div>
          </div>
          <div className="line-clamp-3 text-[0.875rem] font-normal leading-normal text-[#333] group-hover:underline">
            {name}
          </div>
        </Link>
      </div>
      <Rating name="read-only" value={rating} readOnly />
      <p className="text-normal font-bold leading-[1.21] text-[#C11616]">
        {formatPrice(priceAfterDiscount)}
      </p>
      <div className="flex flex-row items-center gap-1">
        <p className="text-[0.75rem] font-bold leading-[1.21] text-[#8C8F8D] line-through">
          {formatPrice(price)}
        </p>
        <div className="rounded-full bg-[#C11616] p-1 text-[0.625rem] font-bold text-white">{`-${discount}%`}</div>
      </div>
      <button className="text-normal w-full rounded-full bg-[#1F5ADD] py-3 leading-[1.21] text-white transition-all duration-300 hover:bg-[#2c6af0]">
        Chọn mua
      </button>
    </div>
  );
};

export default HomeProductCard;
