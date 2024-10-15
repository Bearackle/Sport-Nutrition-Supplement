import SideBar from "@/components/nav-bar/SideBar";
import { cn } from "@/lib/utils";
import { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";

// ** Import images
import BrandLogoSection from "@/components/home/BrandLogoSection";
import CategoryBar from "@/components/home/CategoryBar";
import ClearanceSaleSection from "@/components/home/ClearanceSaleSection";
import CouponCard from "@/components/home/CouponCard";
import TopDealSection from "@/components/home/TopDealSection";
import cafeMocha from "/public/product-banners/cafe-mocha.jpeg";
import liciousGainer from "/public/product-banners/licious-gainer-banner.png";
import megaMass from "/public/product-banners/mega-mass-banner.png";
import proteinGainer from "/public/product-banners/protein-gainer-banner.png";

export const metadata: Metadata = {
  title: "4H | Thực phẩm thể hình chính hãng",
  description:
    "4H | Thương hiệu hàng đầu về sản phẩm dinh dưỡng thể thao, giúp bạn nâng cao hiệu suất và chăm sóc sức khỏe toàn diện.",
};

const couponData = {
  title: "MÃ 5% GIẢM TỐI ĐA 50K",
  shortDescription: [
    "🔅Áp dụng toàn bộ sản phẩm",
    "🔅Giảm tối đa 50k",
    "🔅Áp dụng đơn > 399k",
  ],
  conditionUrl: "#",
  code: "36A666",
};

export default function Home() {
  return (
    <div className="relative w-full">
      <div className="mx-auto flex w-full max-w-[75rem] flex-row justify-around py-8">
        <SideBar />
        <div className="w-[90%] space-y-7 overflow-hidden ml:w-[52.5rem]">
          <div
            className={cn(
              "flex w-full flex-row items-center justify-evenly rounded-[0.9375rem] bg-white xl:h-[27.5rem]",
            )}
          >
            <Link
              href="#"
              className="w-full rounded-[0.625rem] xl:h-[25.875rem] xl:w-[31.25rem]"
            >
              <Image
                src={cafeMocha}
                alt="banner"
                className="h-full w-full rounded-[0.625rem] object-cover"
              />
            </Link>
            <div className="hidden w-[18.75rem] flex-col gap-[0.875rem] xl:flex">
              <Link href="#" className="h-[12.5rem] w-full rounded-[0.625rem]">
                <Image
                  src={cafeMocha}
                  alt="banner"
                  className="h-full w-full rounded-[0.625rem] object-cover"
                />
              </Link>
              <Link href="#" className="h-[12.5rem] w-full rounded-[0.625rem]">
                <Image
                  src={cafeMocha}
                  alt="banner"
                  className="h-full w-full rounded-[0.625rem] object-cover"
                />
              </Link>
            </div>
          </div>
          <CategoryBar />
          <div className="flex w-full flex-row items-center gap-4 overflow-x-scroll ml:justify-between ml:overflow-hidden xl:h-[7.375rem]">
            <CouponCard {...couponData} />
            <CouponCard {...couponData} />
            <CouponCard {...couponData} />
          </div>
          <TopDealSection />
          <div className="flex h-[18rem] w-full flex-row items-center gap-4 overflow-x-scroll rounded-[0.9375rem] bg-white px-3 ml:justify-evenly ml:gap-0 ml:overflow-hidden ml:px-0">
            <Link href="#" className="flex-shrink-0">
              <Image
                src={proteinGainer}
                alt="Protein Gainer"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
            <Link href="#" className="flex-shrink-0">
              <Image
                src={liciousGainer}
                alt="Licious Gainer"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
            <Link href="#" className="flex-shrink-0">
              <Image
                src={megaMass}
                alt="Mega Mass"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
          </div>
          <ClearanceSaleSection />
          <BrandLogoSection />
        </div>
      </div>
    </div>
  );
}