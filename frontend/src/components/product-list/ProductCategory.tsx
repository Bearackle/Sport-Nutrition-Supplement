// ** Import next
import Image, { StaticImageData } from "next/image";
import Link from "next/link";
import { usePathname } from "next/navigation";

type TProps = {
  category: {
    label: string;
    icon: string | StaticImageData;
    href: string;
    amount?: number;
    children?: {
      label: string;
      icon: string | StaticImageData;
      href: string;
    }[];
  };
};

const ProductCategory = ({ category }: TProps) => {
  const pathname = usePathname();
  if (pathname === "/products/all") {
    if (category.children) {
      return (
        <Link
          href={category.children[0].href}
          className="flex flex-1 flex-row items-center gap-3 rounded-xl bg-white p-3 leading-[1.21]"
        >
          <div className="size-10">
            <Image
              src={category.children[0].icon}
              alt={category.label}
              width={40}
              height={40}
              className="h-10 w-auto"
            />
          </div>
          <div className="w-full">
            <div className="text-[0.875rem] font-medium">{category.label}</div>
          </div>
        </Link>
      );
    } else {
      return (
        <Link
          href={category.href}
          className="flex flex-1 flex-row items-center gap-3 rounded-xl bg-white p-3 leading-[1.21]"
        >
          <div className="size-10">
            <Image
              src={category.icon}
              alt={category.label}
              width={40}
              height={40}
              className="h-10 w-auto"
            />
          </div>
          <div className="w-full">
            <div className="text-[0.875rem] font-medium">{category.label}</div>
          </div>
        </Link>
      );
    }
  } else {
    return (
      <Link
        href={category.href}
        className="flex flex-1 flex-row items-center gap-3 rounded-xl bg-white p-3 leading-[1.21]"
      >
        <div className="size-10">
          <Image
            src={category.icon}
            alt={category.label}
            width={40}
            height={40}
            className="h-10 w-auto"
          />
        </div>
        <div className="w-full">
          {category.amount ? (
            <div className="text-[0.875rem] font-medium">{category.label}</div>
          ) : (
            <></>
          )}
        </div>
      </Link>
    );
  }
};

export default ProductCategory;
