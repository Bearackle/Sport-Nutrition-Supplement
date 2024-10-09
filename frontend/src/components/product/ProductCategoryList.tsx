"use client";

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
  if (pathname === "/collections/all") {
    categories = navList.slice(0, -2);
  } else {
    // Call API to get categories
  }
  return (
    <div className="w-full px-[0.625rem]">
      <div className="grid grid-cols-2 gap-x-3 gap-y-2 ml:grid-cols-3 xl:grid-cols-4">
        {categories.map((category, index) => (
          <div key={index}>
            {pathname === "/collections/all" ? (
              <>
                {category.children ? (
                  <ProductCategory
                    image={category.children[0].icon}
                    name={category.label}
                    url={category.children[0].href}
                  />
                ) : (
                  <ProductCategory
                    image={category.icon}
                    name={category.label}
                    url={category.href}
                  />
                )}
              </>
            ) : (
              <>
                <ProductCategory
                  key={index}
                  image={category.icon}
                  name={category.label}
                  url={category.href}
                  amount={category.amount}
                />
              </>
            )}
          </div>
        ))}
      </div>
    </div>
  );
};

export default ProductCategoryList;
