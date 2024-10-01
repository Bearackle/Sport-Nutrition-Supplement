import { cn } from "@/lib/utils";
import Image from "next/image";
import allProducts from "/public/categories/all-products.svg";
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
        label: "Whey Protein",
        icon: "",
        href: "#",
      },
      {
        label: "Protein Trải Dài",
        icon: "",
        href: "#",
      },
      {
        label: "Protein Thực Vật",
        icon: "",
        href: "#",
      },
      {
        label: "Whey Protein Thực Phẩm Thể Thao (All Products)",
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
    icon: allProducts,
    href: "#",
  },
];

const SideBar = () => {
  return (
    <div
      className={cn("sticky top-8 h-[37.75rem] w-[20rem] rounded-2xl bg-white")}
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
                              <div className="flex w-8 items-center justify-center">
                                {childNav.icon && (
                                  <Image
                                    src={childNav.icon}
                                    alt={childNav.label}
                                    className={cn(
                                      "h-8 w-auto",
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
