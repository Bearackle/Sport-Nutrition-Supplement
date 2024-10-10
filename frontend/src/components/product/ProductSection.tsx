"use client";
import { cn } from "@/lib/utils";
import { useState } from "react";
import CustomPagination from "../common/CustomPagination";
import MobileFilter from "./MobileFilter";
import ProductCard from "./ProductCard";

const data = Array.from({ length: 11 }, (_, i) => ({
  id: i,
  image:
    "https://s3-alpha-sig.figma.com/img/12e6/74fb/2c212ef3f0d69e729019abe60b526a57?Expires=1728864000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=B6mHWBTG3mHNsoTIAaP310gqNaPysqZkXT1fA~Mg9PxuFG7UqLCXHDjyJKpCagoAcLs5FAOpiVYwZ0J--OS1jdiST1GBU5cdVSOUbn7h6xrcY-66N5UZLI3wKiecbwzL-TTC8nKJ32YLquSk4ZOKkWMcf-XY2e6ufTsGWQwLbintnBtC~vJtai8WtPFJz7SHB7b6LLH~cr7jFc832dhC48wstb6Z8id-EhocAXO-yDzHLHlEou~-7ShD5~AFl5zjDFhwRaD6GS9gpXGlVkkLQWzfbaDooav87G7~xUe~q3anIiuCn4cM6uhJYctJeOT3Bm2KP1KhMAP9tAypFF2AiA__",
  name: "RULE 1 PROTEIN (ĐỎ) WHEY ISOLATE TĂNG CƠ BẮP - 5 LBS",
  rating: 4,
  price: 1950000,
  discount: 20,
  priceAfterDiscount: 1579000,
}));

type SortOptions = "popular" | "price-asc" | "price-desc";

const ProductSection = () => {
  const [sortOption, setSortOption] = useState<SortOptions>("popular");
  const [currentPage, setCurrentPage] = useState(1);
  return (
    <div className="w-full">
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
          <div className="flex flex-row items-center gap-1 border-l border-solid border-[#333]/30 p-2">
            <MobileFilter />
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

      <div className="mx-auto mt-4 grid w-[95%] grid-cols-2 gap-2 xs:grid-cols-3 ml:grid-cols-4 ml:gap-5 xl:w-full">
        {data.map((product) => (
          <ProductCard key={product.id} {...product} />
        ))}
      </div>
      <div className="mt-6 flex justify-center">
        <CustomPagination
          currentPage={currentPage}
          setCurrentPage={setCurrentPage}
          count={10}
        />
      </div>
    </div>
  );
};

export default ProductSection;
