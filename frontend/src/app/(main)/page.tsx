import SideBar from "@/components/SideBar";
import { cn } from "@/lib/utils";
import { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";

// ** Import images
import CategoryBar from "@/components/home/CategoryBar";
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

const data = {
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
        <div className="w-[52.5rem] space-y-7">
          <div
            className={cn(
              "flex h-[27.5rem] w-full flex-row items-center justify-evenly rounded-[0.9375rem] bg-white",
            )}
          >
            <Link
              href="#"
              className="h-[25.875rem] w-[31.25rem] rounded-[0.625rem]"
            >
              <Image
                src={cafeMocha}
                alt="banner"
                className="h-full w-full rounded-[0.625rem] object-cover"
              />
            </Link>
            <div className="flex w-[18.75rem] flex-col gap-[0.875rem]">
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
          <div className="flex h-[7.375rem] w-full flex-row items-center justify-between">
            <CouponCard {...data} />
            <CouponCard {...data} />
            <CouponCard {...data} />
          </div>
          <TopDealSection />
          <div className="flex h-[18rem] w-full flex-row items-center justify-evenly rounded-[0.9375rem] bg-white">
            <Link href="#">
              <Image
                src={proteinGainer}
                alt="Protein Gainer"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
            <Link href="#">
              <Image
                src={liciousGainer}
                alt="Licious Gainer"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
            <Link href="#">
              <Image
                src={megaMass}
                alt="Mega Mass"
                loading="lazy"
                className="size-[16.5625rem] rounded-[0.625rem] transition-all duration-300 hover:scale-90"
              />
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
