"use client";
import { cn } from "@/lib/utils";
import Image from "next/image";
import { useState } from "react";
import { CustomCarousel } from "../common/CustomCarousel";
import { CarouselItem } from "../ui/carousel";
import HomeProductCard from "./HomeProductCard";
import arrow from "/public/arrow.svg";

const data1 = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  image:
    "https://s3-alpha-sig.figma.com/img/12e6/74fb/2c212ef3f0d69e729019abe60b526a57?Expires=1728864000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=B6mHWBTG3mHNsoTIAaP310gqNaPysqZkXT1fA~Mg9PxuFG7UqLCXHDjyJKpCagoAcLs5FAOpiVYwZ0J--OS1jdiST1GBU5cdVSOUbn7h6xrcY-66N5UZLI3wKiecbwzL-TTC8nKJ32YLquSk4ZOKkWMcf-XY2e6ufTsGWQwLbintnBtC~vJtai8WtPFJz7SHB7b6LLH~cr7jFc832dhC48wstb6Z8id-EhocAXO-yDzHLHlEou~-7ShD5~AFl5zjDFhwRaD6GS9gpXGlVkkLQWzfbaDooav87G7~xUe~q3anIiuCn4cM6uhJYctJeOT3Bm2KP1KhMAP9tAypFF2AiA__",
  name: "RULE 1 PROTEIN (ĐỎ) WHEY ISOLATE TĂNG CƠ BẮP - 5 LBS",
  rating: 4,
  price: 1950000,
  discount: 20,
  priceAfterDiscount: 1579000,
}));

const data2 = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  image:
    "https://s3-alpha-sig.figma.com/img/059c/7008/39f77b67fd56fbeb5c7b5da01b8e87f4?Expires=1728864000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=A7TXXEyDVhX-WLkaIdNnnHI-mUgxlP75AyTTyBK1gErvQW6dm61g5Z3dhoTTjbQfVm98RCwtctdrHHNnWNsvBFFBATACm7XcofWYIUYTxzx0AXw6DEEPJPDRpUiKPlrtRZ~vcDvEe7qsY-rjwI7rzQRXiuhA9xPPxn6bKlDegEn0r3P7fR4i86QxrkN1gzVOKAwUL0WQsLXKfKl698DgQchEElE5FiBOzurxh4EGPKgHJHBXtn8j88ZGqzziNCGdBGLhbuF3RWNlianmB3Sy-8A7VKvkLB7HAKhfkkFvegf6mQreu05~8H7Ey7HNv~a89FBzRLxAEry~e7QzUORrIQ__",
  name: "RULE 1 PROTEIN (ĐỎ) WHEY ISOLATE TĂNG CƠ BẮP - 5 LBS",
  rating: 4,
  price: 1950000,
  discount: 20,
  priceAfterDiscount: 1579000,
}));

const ClearanceSaleSection = () => {
  const [activeProduct, setActiveProduct] = useState("clearance-sale");
  const displayData = activeProduct === "clearance-sale" ? data1 : data2;
  return (
    <div className="w-full rounded-[0.9375rem] bg-white p-4 pb-3">
      <div className="flex flex-row items-center justify-between">
        <h3 className="mb-2 text-[1.25rem] font-bold uppercase leading-[1.21] text-[#333]">
          Thanh lý - Xả kho
        </h3>
        <div className="flex flex-row gap-2 text-[0.875rem] leading-[1.21] transition-all duration-300">
          <button
            onClick={() => setActiveProduct("clearance-sale")}
            className={cn(
              "rounded-[0.625rem] px-2 py-1 transition-all duration-200",
              activeProduct === "clearance-sale"
                ? "bg-[#0A68FF] text-white"
                : "boder-solid border border-[#8C8F8D] bg-white text-[#333]",
            )}
          >
            Sale xả kho
          </button>
          <button
            onClick={() => setActiveProduct("liquidation")}
            className={cn(
              "rounded-[0.625rem] px-2 py-1 transition-all duration-200",
              activeProduct === "liquidation"
                ? "bg-[#0A68FF] text-white"
                : "boder-solid border border-[#8C8F8D] bg-white text-[#333]",
            )}
          >
            Thanh lý hàng lỗi
          </button>
        </div>
      </div>
      <div className="mt-2 w-full px-4">
        <CustomCarousel>
          {displayData.map((product, index) => (
            <CarouselItem
              key={product.id}
              className="flex basis-1/3 justify-center"
            >
              <HomeProductCard index={index} {...product} />
            </CarouselItem>
          ))}
        </CustomCarousel>
      </div>
      <div className="mt-2 flex justify-center">
        <button className="flex flex-row items-center rounded-[0.625rem] border border-solid border-[#8C8F8D] px-2 py-1 text-[0.875rem]">
          Xem tất cả{" "}
          <Image src={arrow} alt="arrow" className="size-4 leading-[1.21]" />
        </button>
      </div>
    </div>
  );
};

export default ClearanceSaleSection;
