"use client";
import { cn } from "@/lib/utils";
import { useState } from "react";

type SortOptions = "popular" | "price-asc" | "price-desc";

const ProductSection = () => {
  const [sortOption, setSortOption] = useState<SortOptions>("popular");
  return (
    <div className="flex flex-row items-center justify-between">
      <h3 className="text-[1.125rem] font-bold text-black">
        Danh mục sản phẩm
      </h3>
      <div className="flex flex-row items-center gap-4 text-[0.875rem] font-bold leading-[1.21]">
        <span className="text-[1.125rem] font-normal">Sắp xếp theo</span>
        <button
          onClick={() => {
            if (sortOption !== "popular") setSortOption("popular");
          }}
          className={cn(
            "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
            sortOption === "popular"
              ? "border-[#1F5ADD] text-[#1F5ADD]"
              : "border-[#8C8F8D] text-[#8C8F8D]",
          )}
        >
          Bán chạy
        </button>
        <button
          onClick={() => {
            if (sortOption !== "price-asc") setSortOption("price-asc");
          }}
          className={cn(
            "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
            sortOption === "price-asc"
              ? "border-[#1F5ADD] text-[#1F5ADD]"
              : "border-[#8C8F8D] text-[#8C8F8D]",
          )}
        >
          Giá thấp
        </button>
        <button
          onClick={() => {
            if (sortOption !== "price-desc") setSortOption("price-desc");
          }}
          className={cn(
            "rounded-full border border-solid bg-white px-3 py-2 transition-all duration-300",
            sortOption === "price-desc"
              ? "border-[#1F5ADD] text-[#1F5ADD]"
              : "border-[#8C8F8D] text-[#8C8F8D]",
          )}
        >
          Giá cao
        </button>
      </div>
    </div>
  );
};

export default ProductSection;
