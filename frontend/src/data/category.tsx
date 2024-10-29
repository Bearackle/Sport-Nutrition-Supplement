// ** Import images
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
import bcaaeaa from "/public/categories/bcaa-eaa.png";
import bcaa from "/public/categories/bcaa.png";
import betaAlanine from "/public/categories/beta-alanine.png";
import caffeine from "/public/categories/caffeine.png";
import citrulline from "/public/categories/citrulline.png";
import creatine from "/public/categories/creatine.png";
import diet from "/public/categories/diet.svg";
import eaa from "/public/categories/eaa.png";
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
import { TParamsCategory } from "@/types/category";

export const productCategories: Array<TParamsCategory> = [
  {
    id: "daily-deal",
    label: "GIÁ SIÊU ƯU ĐÃI",
    icon: saleIcon,
  },
  {
    id: "deal-hot-combo-tiet-kiem",
    label: "Deal Hot - Combo Tiết Kiệm",
    icon: saleIcon,
  },
  {
    id: "whey-protein-category",
    label: "Whey Protein (Sữa Tăng Cơ)",
    icon: wheyProtein,
    children: [
      {
        id: "whey-protein-all",
        label: "Whey Protein Thực Phẩm Thể Thao (Tất Cả Sản Phẩm)",
        icon: allWhey,
      },
      {
        id: "whey-protein",
        label: "Whey Protein",
        icon: wheyProtein2,
      },
      {
        id: "protein-trai-dai",
        label: "Protein Trải Dài",
        icon: wheyBlend,
      },
      {
        id: "protein-thuc-vat",
        label: "Protein Thực Vật",
        icon: wheyPlant,
      },
    ],
  },
  {
    id: "mass-gainer-category",
    label: "Mass Gainer (Sữa Tăng Cân)",
    icon: massGainer,
    children: [
      {
        id: "mass-gainer-all",
        label: "Tất Cả Mass Gainer",
        icon: allMass,
      },
      {
        id: "mass-cao-nang-luong",
        label: "Mass Cao Năng Lượng",
        icon: hightMass,
      },
      {
        id: "mass-trung-nang-luong",
        label: "Mass Trung Năng Lượng",
        icon: mediumMass,
      },
    ],
  },
  {
    id: "eaa-bcaa-category",
    label: "EAA-BCAA (Amino Thiết Yếu)",
    icon: amino,
    children: [
      {
        id: "eaa-bcaa-all",
        label: "Tất cả BCAA-EAA",
        icon: bcaaeaa,
      },
      {
        id: "eaa",
        label: "EAA",
        icon: eaa,
      },
      {
        id: "bcaa",
        label: "BCAA",
        icon: bcaa,
      },
    ],
  },
  {
    id: "fat-burner-category",
    label: "Fat Burner (Đốt Mỡ)",
    icon: fatBurner,
    children: [
      {
        id: "fat-burner-all",
        label: "Tất cả Fat Burner",
        icon: allFat,
      },
      {
        id: "dot-mo-co-chat-kich-thich",
        label: "Đốt Mỡ Có Chất Kích Thích",
        icon: fatCaffeine,
      },
      {
        id: "dot-mo-khong-chat-kich-thich",
        label: "Đốt Mỡ Không Chất Kích Thích",
        icon: fatNoCaffeine,
      },
    ],
  },
  {
    id: "pre-workout-category",
    label: "Pre-Workout (Tăng Sức Mạnh)",
    icon: workout,
    children: [
      {
        id: "tang-suc-manh-all",
        label: "Tất Cả Pre-Workout",
        icon: allPreworkout,
      },
      {
        id: "tang-suc-manh-co-caffeine",
        label: "Tăng Sức Mạnh Có Caffeine",
        icon: preworkoutCaffeine,
      },
      {
        id: "tang-suc-manh-khong-caffeine",
        label: "Tăng Sức Mạnh Không Caffeine",
        icon: preworkoutNoCaffeine,
      },
    ],
  },
  {
    id: "vitamin-category",
    label: "Vitamin (Tăng Cường Sức Khỏe)",
    icon: vitamin,
    children: [
      {
        id: "vitamin-all",
        label: "Tất Cả Các Loại Vitamin",
        icon: allVitamin,
      },
      {
        id: "vitamin-suc-khoe",
        label: "Vitamin Sức Khỏe",
        icon: vitaminHealthy,
      },
      {
        id: "thuc-pham-sac-dep",
        label: "Thực phẩm Sắc Đẹp",
        icon: vitaminBeauty,
      },
      {
        id: "zinc-magnesium-b6",
        label: "ZMA (Zinc - Magnesium - B6)",
        icon: zma,
      },
    ],
  },
  {
    id: "element-category",
    label: "Đơn Chất",
    icon: element,
    children: [
      {
        id: "don-chat-all",
        label: "Tất Cả Các Đơn Chất",
        icon: allElements,
      },
      {
        id: "creatine",
        label: "Creatine",
        icon: creatine,
      },
      {
        id: "caffeine",
        label: "Caffeine",
        icon: caffeine,
      },
      {
        id: "beta-alanine",
        label: "Beta Alanine",
        icon: betaAlanine,
      },
      {
        id: "citrulline",
        label: "Citrulline",
        icon: citrulline,
      },
      {
        id: "arginine",
        label: "Arginine",
        icon: arginine,
      },
      {
        id: "taurine",
        label: "Taurine",
        icon: taurine,
      },
      {
        id: "cac-don-chat-khac",
        label: "Các Đơn Chất Khác",
        icon: otherElements,
      },
    ],
  },
  {
    id: "diet-category",
    label: "Thực Phẩm Ăn Kiêng",
    icon: diet,
    children: [
      {
        id: "ngu-coc",
        label: "Tất Cả Các Loại Thực Phẩm Ăn Kiêng",
        icon: allDiet,
      },
    ],
  },
  {
    id: "practice-category",
    label: "Phụ Kiện Tập Luyện",
    icon: practice,
    children: [
      {
        id: "phu-kien",
        label: "Tất Cả Phụ Kiện",
        icon: allAccessories,
      },
    ],
  },
  {
    id: "sale-tag",
    label: "Thanh Lý Hàng Lỗi",
    icon: saleTag,
    children: [
      {
        id: "xa-kho-sale",
        label: "XẢ KHO SALE",
        icon: saleTag,
      },
    ],
  },
  {
    id: "tra-cuu-san-pham",
    label: "Tra Cứu Sản Phẩm",
    icon: lookup,
  },
  {
    id: "all",
    label: "Tất cả sản phẩm",
    icon: allProducts,
  },
];
