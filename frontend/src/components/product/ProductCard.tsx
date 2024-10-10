import { formatPrice } from "@/lib/utils";
import { Rating } from "@mui/material";
import Image from "next/image";
import Link from "next/link";

type TProps = {
  id: number;
  image: string;
  name: string;
  rating: number;
  price: number;
  discount: number;
  priceAfterDiscount: number;
};

const ProductCard = ({
  id,
  image,
  name,
  rating,
  price,
  discount,
  priceAfterDiscount,
}: TProps) => {
  return (
    <div
      id={id.toString()}
      className="group mx-auto space-y-1 overflow-hidden rounded-[0.625rem] bg-white px-4 py-3 xs:w-[13rem]"
    >
      <div>
        <Image
          src={image}
          alt={name}
          width={145}
          height={145}
          className="mx-auto h-[9.0625rem] w-auto"
        />
      </div>
      <div className="pt-3">
        <Link href={"#"} className="space-y-1">
          <div className="line-clamp-3 text-[0.825rem] font-normal leading-normal text-[#333] group-hover:underline xs:text-[0.875rem]">
            {name}
          </div>
        </Link>
      </div>
      <Rating name="read-only" value={rating} readOnly />
      <p className="text-normal font-bold leading-[1.21] text-[#C11616]">
        {formatPrice(priceAfterDiscount)}
      </p>
      <div className="flex flex-row items-center gap-1 pb-1">
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

export default ProductCard;
