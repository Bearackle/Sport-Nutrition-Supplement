"use client";

import { cn } from "@/lib/utils";
import { usePathname } from "next/navigation";
import ProductCategory from "./ProductCategory";
import { productCategories } from "@/data/category";
import { TParamsCategoryWithAmount } from "@/types/category";

const ProductCategoryList = () => {
  const pathname = usePathname();
  let categories: TParamsCategoryWithAmount[] = [];
  if (pathname === "/products/all") {
    categories = productCategories.slice(0, -2);
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
