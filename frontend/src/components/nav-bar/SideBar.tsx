import { cn } from "@/lib/utils";
import Image from "next/image";

// ** Import images
import arrow from "/public/arrow.svg";
import bcaaeaa from "/public/categories/BCAA-EAA.png";
import bcaa from "/public/categories/BCAA.png";
import eaa from "/public/categories/EAA.png";
import allAccessories from "/public/categories/all-accessories.svg";
import allDiet from "/public/categories/all-diet.webp";
import allElements from "/public/categories/all-elements.png";
import allFat from "/public/categories/all-fat.png";
import allMass from "/public/categories/all-mass.png";
import allPreworkout from "/public/categories/all-preworkout.png";
import allProducts from "/public/categories/all-products.svg";
import allVitamin from "/public/categories/all-vitamin.png";
import allWhey from "/public/categories/all-whey.png";
import amino from "/public/categories/amino.svg";
import arginine from "/public/categories/arginine.png";
import betaAlanine from "/public/categories/beta-alanine.png";
import caffeine from "/public/categories/caffeine.png";
import citrulline from "/public/categories/citrulline.png";
import creatine from "/public/categories/creatine.png";
import diet from "/public/categories/diet.svg";
import element from "/public/categories/element.png";
import fatBurner from "/public/categories/fat-burner.svg";
import fatCaffeine from "/public/categories/fat-caffeine.png";
import fatNoCaffeine from "/public/categories/fat-no-caffeine.png";
import hightMass from "/public/categories/high-mass.png";
import lookup from "/public/categories/lookup.svg";
import massGainer from "/public/categories/mass-gainer.svg";
import mediumMass from "/public/categories/medium-mass.png";
import otherElements from "/public/categories/other-elements.png";
import practice from "/public/categories/practice.svg";
import preworkoutCaffeine from "/public/categories/preworkout-caffeine.png";
import preworkoutNoCaffeine from "/public/categories/preworkout-no-caffeine.png";
import taurine from "/public/categories/taurine.png";
import vitaminBeauty from "/public/categories/vitamin-beauty.png";
import vitaminHealthy from "/public/categories/vitamin-healthy.png";
import vitamin from "/public/categories/vitamin.svg";
import wheyBlend from "/public/categories/whey-blend.png";
import wheyPlant from "/public/categories/whey-plant.png";
import wheyProtein2 from "/public/categories/whey-protein.png";
import wheyProtein from "/public/categories/whey-protein.svg";
import workout from "/public/categories/workout.svg";
import zma from "/public/categories/zma.png";
import saleIcon from "/public/sale-icon.svg";
import saleTag from "/public/sale-tag.svg";

export const navList = [
  {
    label: "GIÁ SIÊU ƯU ĐÃI",
    icon: saleIcon,
    href: "/",
  },
  {
    label: "Deal Hot - Combo Tiết Kiệm",
    icon: saleIcon,
    href: "/",
  },
  {
    label: "Whey Protein (Sữa Tăng Cơ)",
    icon: wheyProtein,
    children: [
      {
        label: "Whey Protein Thực Phẩm Thể Thao (Tất Cả Sản Phẩm)",
        icon: allWhey,
        href: "/",
      },
      {
        label: "Whey Protein",
        icon: wheyProtein2,
        href: "/",
      },
      {
        label: "Protein Trải Dài",
        icon: wheyBlend,
        href: "/",
      },
      {
        label: "Protein Thực Vật",
        icon: wheyPlant,
        href: "/",
      },
    ],
  },
  {
    label: "Mass Gainer (Sữa Tăng Cân)",
    icon: massGainer,
    children: [
      {
        label: "Tất Cả Mass Gainer",
        icon: allMass,
        href: "/",
      },
      {
        label: "Mass Cao Năng Lượng",
        icon: hightMass,
        href: "/",
      },
      {
        label: "Mass Trung Năng Lượng",
        icon: mediumMass,
        href: "/",
      },
    ],
  },
  {
    label: "EAA-BCAA (Amino Thiết Yếu)",
    icon: amino,
    children: [
      {
        label: "Tất cả BCAA-EAA",
        icon: bcaaeaa,
        href: "/",
      },
      {
        label: "EAA",
        icon: eaa,
        href: "/",
      },
      {
        label: "BCAA",
        icon: bcaa,
        href: "/",
      },
    ],
  },
  {
    label: "Fat Burner (Đốt Mỡ)",
    icon: fatBurner,
    children: [
      {
        label: "Tất cả Fat Burner",
        icon: allFat,
        href: "/",
      },
      {
        label: "Đốt Mỡ Có Chất Kích Thích",
        icon: fatCaffeine,
        href: "/",
      },
      {
        label: "Đốt Mỡ Không Chất Kích Thích",
        icon: fatNoCaffeine,
        href: "/",
      },
    ],
  },
  {
    label: "Pre-Workout (Tăng Sức Mạnh)",
    icon: workout,
    children: [
      {
        label: "Tất Cả Pre-Workout",
        icon: allPreworkout,
        href: "/",
      },
      {
        label: "Tăng Sức Mạnh Có Caffeine",
        icon: preworkoutCaffeine,
        href: "/",
      },
      {
        label: "Tăng Sức Mạnh Không Caffeine",
        icon: preworkoutNoCaffeine,
        href: "/",
      },
    ],
  },
  {
    label: "Vitamin (Tăng Cường Sức Khỏe)",
    icon: vitamin,
    children: [
      {
        label: "Tất Cả Các Loại Vitamin",
        icon: allVitamin,
        href: "/",
      },
      {
        label: "Vitamin Sức Khỏe",
        icon: vitaminHealthy,
        href: "/",
      },
      {
        label: "Thực phẩm Sắc Đẹp",
        icon: vitaminBeauty,
        href: "/",
      },
      {
        label: "ZMA (Zinc - Magnesium - B6)",
        icon: zma,
        href: "/",
      },
    ],
  },
  {
    label: "Đơn Chất",
    icon: element,
    children: [
      {
        label: "Tất Cả Các Đơn Chất",
        icon: allElements,
        href: "/",
      },
      {
        label: "Creatine",
        icon: creatine,
        href: "/",
      },
      {
        label: "Caffeine",
        icon: caffeine,
        href: "/",
      },
      {
        label: "Beta Alanine",
        icon: betaAlanine,
        href: "/",
      },
      {
        label: "Citrulline",
        icon: citrulline,
        href: "/",
      },
      {
        label: "Arginine",
        icon: arginine,
        href: "/",
      },
      {
        label: "Taurine",
        icon: taurine,
        href: "/",
      },
      {
        label: "Các Đơn Chất Khác",
        icon: otherElements,
        href: "/",
      },
    ],
  },
  {
    label: "Thực Phẩm Ăn Kiêng",
    icon: diet,
    children: [
      {
        label: "Tất Cả Các Loại Thực Phẩm Ăn Kiêng",
        icon: allDiet,
        href: "/",
      },
    ],
  },
  {
    label: "Phụ Kiện Tập Luyện",
    icon: practice,
    children: [
      {
        label: "Tất Cả Phụ Kiện",
        icon: allAccessories,
        href: "/",
      },
    ],
  },
  {
    label: "Thanh Lý Hàng Lỗi",
    icon: saleTag,
    children: [
      {
        label: "XẢ KHO SALE",
        icon: saleTag,
        href: "/",
      },
    ],
  },
  {
    label: "Tra cứu sản phẩm",
    icon: lookup,
    href: "/",
  },
  {
    label: "Tất cả sản phẩm",
    icon: allProducts,
    href: "/collections/all",
  },
];

const SideBar = () => {
  return (
    <div
      className={cn(
        "sticky top-8 z-[1] hidden h-[37.75rem] w-[20rem] rounded-2xl bg-white xl:block",
      )}
    >
      <div className="relative">
        <div className="px-4 py-3">
          <h2 className="text-base font-bold leading-[1.21]">Danh mục</h2>
        </div>
        <nav>
          <ul className="space-y-2">
            {navList.map((nav, index) => (
              <li key={index}>
                {nav.href && (
                  <a
                    href={nav.href}
                    className={cn(
                      "flex min-h-8 flex-row items-center gap-2 px-4 text-[0.875rem] font-semibold text-[#333333] hover:text-[#1250DC] hover:underline",
                    )}
                  >
                    <div className="flex w-8 items-center justify-center">
                      {nav.icon && (
                        <Image
                          src={nav.icon}
                          alt={nav.label}
                          className={cn(
                            "h-8 w-auto",
                            nav.icon ? "" : "opacity-0",
                          )}
                        />
                      )}
                    </div>
                    <span>{nav.label}</span>
                  </a>
                )}
                {nav.children && (
                  <div
                    className={cn(
                      "group relative flex cursor-pointer flex-row items-center gap-2 px-4 text-[0.875rem] font-semibold text-[#333333]",
                    )}
                  >
                    <div className="flex w-8 items-center justify-center">
                      <Image
                        src={nav.icon}
                        alt={nav.label}
                        className={cn(
                          "h-8 w-auto",
                          nav.icon ? "" : "opacity-0",
                        )}
                      />
                    </div>
                    <span className="group-hover:text-[#1250DC] group-hover:underline">
                      {nav.label}
                    </span>
                    <Image
                      src={arrow}
                      alt=""
                      className="absolute right-4 h-5 w-auto"
                    />
                    <div className="absolute top-0 z-[2000] hidden w-[20rem] -translate-y-[50%] translate-x-[19.05rem] flex-col rounded-2xl bg-white py-4 opacity-0 shadow-xl group-hover:flex group-hover:opacity-100 group-hover:transition-opacity group-hover:duration-300">
                      <ul className="space-y-2 px-4">
                        {nav.children.map((childNav, index) => (
                          <li key={index}>
                            <a
                              href={childNav.href}
                              className={cn(
                                "flex min-h-8 flex-row items-center gap-2 text-[0.875rem] font-semibold text-[#333333] hover:text-[#1250DC] hover:underline",
                              )}
                            >
                              <div className="flex w-8 flex-shrink-0 items-center justify-center">
                                {childNav.icon && (
                                  <Image
                                    src={childNav.icon}
                                    alt={childNav.label}
                                    loading="lazy"
                                    className={cn(
                                      "h-8 w-auto object-fill",
                                      childNav.icon ? "" : "opacity-0",
                                    )}
                                  />
                                )}
                              </div>
                              <span>{childNav.label}</span>
                            </a>
                          </li>
                        ))}
                      </ul>
                    </div>
                  </div>
                )}
              </li>
            ))}
          </ul>
        </nav>
      </div>
    </div>
  );
};

export default SideBar;
