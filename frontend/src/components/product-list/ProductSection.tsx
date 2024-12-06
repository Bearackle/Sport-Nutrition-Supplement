"use client";
import productApiRequest from "@/apiRequests/product";
import { filterBrands } from "@/data/brand";
import { categories } from "@/data/category";
import { cn, getKeyByValueIgnoreCase } from "@/lib/utils";
import {
  ProductsMetaType,
  ProductsResType,
} from "@/schemaValidations/product.schema";
import { useSearchParams } from "next/navigation";
import { useEffect, useRef, useState } from "react";
import CustomPagination from "../common/CustomPagination";
import MobileFilter from "./MobileFilter";
import ProductCard from "./ProductCard";
import { ProductsLoading } from "./ProductsLoading";

type SortOptions = "asc" | "desc";

const ProductSection = ({ category }: { category: string }) => {
  const productsContainerRef = useRef<HTMLDivElement>(null);
  const searchParams = useSearchParams();
  const [currentPage, setCurrentPage] = useState(1);
  const [data, setData] = useState<ProductsResType>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [meta, setMeta] = useState<ProductsMetaType>({
    current_page: 1,
    from: null,
    last_page: 1,
    links: [],
    path: "",
    per_page: 12,
    to: null,
    total: 0,
  });
  const [sortOption, setSortOption] = useState<SortOptions>("asc");

  useEffect(() => {
    setCurrentPage(1);
  }, [searchParams]);

  useEffect(() => {
    setIsLoading(true);
    const paramsObject: Record<string, string[]> = {};

    searchParams.forEach((value, key) => {
      if (!paramsObject[key]) {
        paramsObject[key] = [];
      }
      if (key === "category") {
        const categoryValue = getKeyByValueIgnoreCase(categories, value || "");
        if (categoryValue) {
          paramsObject[key].push(categoryValue);
        }
      } else if (key === "brand") {
        const brandValue = getKeyByValueIgnoreCase(filterBrands, value || "");
        if (brandValue) {
          paramsObject[key].push(brandValue);
        }
      } else paramsObject[key].push(value);
    });

    const params = {
      page: [currentPage.toString()],
      sortByPrice: [sortOption],
      ...paramsObject,
    };

    // Query products
    if (category === "tat-ca-san-pham") {
      productApiRequest
        .allProducts(buildSearchParams(params))
        .then((result) => {
          setData(result.payload.data);
          setMeta(result.payload.meta);
        })
        .finally(() => setIsLoading(false));
    } else {
      productApiRequest
        .categoryProducts(category, buildSearchParams(params))
        .then((result) => setData(result.payload.data))
        .finally(() => setIsLoading(false));
    }
  }, [searchParams, sortOption, currentPage]);

  const buildSearchParams = (params: Record<string, string[]>): string => {
    const urlSearchParams = new URLSearchParams();

    Object.entries(params).forEach(([key, values]) => {
      values.forEach((value) => {
        urlSearchParams.append(key, value);
      });
    });

    return urlSearchParams.toString();
  };
  return (
    <div ref={productsContainerRef} className="w-full">
      <div className="w-full bg-white xl:hidden">
        <div className="border-b border-solid border-[#333]/30 px-3 py-4">
          <h3 className="text-[1.125rem] font-bold text-black">
            Danh mục sản phẩm
          </h3>
        </div>
        <div className="flex flex-row items-center justify-between px-3 py-2">
          <div className="flex flex-row items-center gap-2 text-[0.875rem] font-bold leading-[1.21] ml:gap-4">
            <span className="hidden text-base font-normal xs:block">
              Sắp xếp theo
            </span>
            <button
              onClick={() => {
                if (sortOption !== "asc") setSortOption("asc");
              }}
              className={cn(
                "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
                sortOption === "asc"
                  ? "border-[#1F5ADD] text-[#1F5ADD]"
                  : "border-[#8C8F8D] text-[#8C8F8D]",
              )}
            >
              Giá thấp
            </button>
            <button
              onClick={() => {
                if (sortOption !== "desc") setSortOption("desc");
              }}
              className={cn(
                "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
                sortOption === "desc"
                  ? "border-[#1F5ADD] text-[#1F5ADD]"
                  : "border-[#8C8F8D] text-[#8C8F8D]",
              )}
            >
              Giá cao
            </button>
          </div>
          <div className="flex flex-row items-center gap-1 border-l border-solid border-[#333]/30 p-2">
            <MobileFilter category={category} />
          </div>
        </div>
      </div>
      <div className="hidden flex-row items-center justify-between xl:flex">
        <h3 className="text-[1.125rem] font-bold text-black">
          Danh mục sản phẩm
        </h3>
        <div className="flex flex-row items-center gap-4 text-[0.875rem] font-bold leading-[1.21]">
          <span className="text-[1.125rem] font-normal">Sắp xếp theo</span>
          <button
            onClick={() => {
              if (sortOption !== "asc") setSortOption("asc");
            }}
            className={cn(
              "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
              sortOption === "asc"
                ? "border-[#1F5ADD] text-[#1F5ADD]"
                : "border-[#8C8F8D] text-[#8C8F8D]",
            )}
          >
            Giá thấp
          </button>
          <button
            onClick={() => {
              if (sortOption !== "desc") setSortOption("desc");
            }}
            className={cn(
              "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
              sortOption === "desc"
                ? "border-[#1F5ADD] text-[#1F5ADD]"
                : "border-[#8C8F8D] text-[#8C8F8D]",
            )}
          >
            Giá cao
          </button>
        </div>
      </div>
      {/* Products */}
      {isLoading ? (
        <ProductsLoading />
      ) : (
        <div>
          {data && data.length > 0 ? (
            <>
              <div className="mx-auto mt-8 grid w-[95%] grid-cols-2 gap-x-2 gap-y-4 sm:grid-cols-3 sm:gap-y-6 ml:grid-cols-4 ml:gap-y-4 xl:mt-4 xl:w-full">
                {data.map((product) => (
                  <ProductCard key={product.productId} {...product} />
                ))}
              </div>
              <div className="mt-6 flex justify-center">
                <CustomPagination
                  count={meta.last_page}
                  currentPage={currentPage}
                  scrollToRef={productsContainerRef}
                  setCurrentPage={setCurrentPage}
                />
              </div>
            </>
          ) : (
            <div className="w-full pt-12 text-center text-lg text-[#333]">
              Không tìm thấy sản phẩm
            </div>
          )}
        </div>
      )}
    </div>
  );
};

export default ProductSection;
