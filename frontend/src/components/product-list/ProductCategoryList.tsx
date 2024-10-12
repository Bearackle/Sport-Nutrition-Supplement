"use client";

import { cn } from "@/lib/utils";
import { StaticImageData } from "next/image";
import { usePathname } from "next/navigation";
import { navList } from "../nav-bar/SideBar";
import ProductCategory from "./ProductCategory";

interface IProductCategory {
  label: string;
  icon: string | StaticImageData;
  href: string;
  amount?: number;
  children?: {
    label: string;
    icon: string | StaticImageData;
    href: string;
  }[];
}

const ProductCategoryList = () => {
  const pathname = usePathname();
  let categories: IProductCategory[] = [];
  if (pathname === "/products/all") {
    categories = navList.slice(0, -2);
  } else {
    // Call API to get categories
  }
  return (
    <div className="w-full px-[0.625rem]">
      <div
        className={cn(
          "grid grid-cols-2 items-stretch gap-x-3 gap-y-2",
          "ml:grid-cols-3 xl:grid-cols-4",
        )}
      >
        {categories.map((category, index) => (
          <ProductCategory category={category} key={index} />
        ))}
      </div>
    </div>
  );
};

export default ProductCategoryList;
