// ** Import next
import Image, { StaticImageData } from "next/image";
import Link from "next/link";

type TProps = {
  image: string | StaticImageData;
  name: string;
  amount?: number;
  url: string;
};

const ProductCategory = ({ image, name, amount, url }: TProps) => {
  return (
    <Link
      href={url}
      className="flex flex-1 flex-row items-center gap-3 rounded-xl bg-white p-3 leading-[1.21]"
    >
      <div className="size-10">
        <Image
          src={image}
          alt={name}
          width={40}
          height={40}
          className="h-10 w-auto"
        />
      </div>
      <div className="w-full">
        {amount ? (
          <></>
        ) : (
          <div className="text-[0.875rem] font-medium">{name}</div>
        )}
      </div>
    </Link>
  );
};

export default ProductCategory;
