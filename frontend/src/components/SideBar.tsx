import { cn } from "@/lib/utils";
import Image from "next/image";
import amino from "/public/categories/amino.svg";
import arrow from "/public/categories/arrow.svg";
import diet from "/public/categories/diet.svg";
import element from "/public/categories/element.png";
import fatBurner from "/public/categories/fat-burner.svg";
import lookup from "/public/categories/lookup.svg";
import massGainer from "/public/categories/mass-gainer.svg";
import practice from "/public/categories/practice.svg";
import vitamin from "/public/categories/vitamin.svg";
import wheyProtein from "/public/categories/whey-protein.svg";
import workout from "/public/categories/workout.svg";
import saleIcon from "/public/sale-icon.svg";
import saleTag from "/public/sale-tag.svg";

const navList = [
  {
    label: "GIÁ SIÊU ƯU ĐÃI",
    icon: saleIcon,
    href: "#",
  },
  {
    label: "Deal Hot - Combo Tiết Kiệm",
    icon: saleIcon,
    href: "#",
  },
  {
    label: "Whey Protein (Sữa Tăng Cơ)",
    icon: wheyProtein,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Mass Gainer (Sữa Tăng Cân)",
    icon: massGainer,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "EAA-BCAA (Amino Thiết Yếu)",
    icon: amino,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Fat Burner (Đốt Mỡ)",
    icon: fatBurner,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Pre-Workout (Tăng Sức Mạnh)",
    icon: workout,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Vitamin (Tăng Cường Sức Khỏe)",
    icon: vitamin,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Đơn Chất",
    icon: element,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Thực Phẩm Ăn Kiêng",
    icon: diet,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Phụ Kiện Tập Luyện",
    icon: practice,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Thanh Lý Hàng Lỗi",
    icon: saleTag,
    children: [
      {
        label: "",
        icon: "",
        href: "#",
      },
    ],
  },
  {
    label: "Tra cứu sản phẩm",
    icon: lookup,
    href: "#",
  },
  {
    label: "Tất cả sản phẩm",
    icon: "",
    href: "#",
  },
];

const SideBar = () => {
  return (
    <nav className={cn("h-fit w-[20rem] rounded-2xl bg-white pb-2")}>
      <div className="px-4 py-3">
        <h2 className="text-base font-bold leading-[1.21]">Danh mục</h2>
      </div>
      <ul className="space-y-2 px-4">
        {navList.map((nav, index) => (
          <li key={index}>
            {nav.href && (
              <a
                href={nav.href}
                className={cn(
                  "flex min-h-8 flex-row items-center gap-2 text-[0.875rem] font-semibold text-[#333333]",
                )}
              >
                <div className="flex w-8 items-center justify-center">
                  {nav.icon && (
                    <Image
                      src={nav.icon}
                      alt={nav.label}
                      className={cn("h-8 w-auto", nav.icon ? "" : "opacity-0")}
                    />
                  )}
                </div>
                <span>{nav.label}</span>
              </a>
            )}
            {nav.children && (
              <div
                className={cn(
                  "relative flex cursor-pointer flex-row items-center gap-2 text-[0.875rem] font-semibold text-[#333333]",
                )}
              >
                <div className="flex w-8 items-center justify-center">
                  <Image
                    src={nav.icon}
                    alt={nav.label}
                    className={cn("h-8 w-auto", nav.icon ? "" : "opacity-0")}
                  />
                </div>
                <span>{nav.label}</span>
                <Image
                  src={arrow}
                  alt=""
                  className="absolute right-0 h-5 w-auto"
                />
              </div>
            )}
          </li>
        ))}
      </ul>
    </nav>
  );
};

export default SideBar;
