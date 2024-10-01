import { cn } from "@/lib/utils";
import Image from "next/image";
import Link from "next/link";

// ** Import images
import accessory from "/public/home/category-bar/accessory.png";
import bcaa from "/public/home/category-bar/bcaa.svg";
import bounty from "/public/home/category-bar/bounty.svg";
import diet from "/public/home/category-bar/diet.svg";
import element from "/public/home/category-bar/element.svg";
import lipo from "/public/home/category-bar/lipo.svg";
import mass from "/public/home/category-bar/mass.svg";
import preworkout from "/public/home/category-bar/pre-workout.svg";
import vitamin from "/public/home/category-bar/vitamin.svg";
import whey from "/public/home/category-bar/whey.png";

const categories = [
  {
    name: "Tăng cơ",
    img: whey,
    bgColor: "#F99A9AB2",
    url: "",
  },
  {
    name: "Tăng cân",
    img: mass,
    bgColor: "#82E885",
    url: "",
  },
  {
    name: "BCAA-EAA",
    img: bcaa,
    bgColor: "#9ACBF9B2",
    url: "",
  },
  {
    name: "Đốt mỡ",
    img: lipo,
    bgColor: "#F9E99AB2",
    url: "",
  },
  {
    name: "Tăng sức mạnh",
    img: preworkout,
    bgColor: "#9F9B9BB2",
    url: "",
  },
  {
    name: "Vitamin Khoáng Chất",
    img: vitamin,
    bgColor: "#F99A9AB2",
    url: "",
  },
  {
    name: "Đơn Chất",
    img: element,
    bgColor: "#F9C79AB2",
    url: "",
  },
  {
    name: "Ăn Kiêng",
    img: diet,
    bgColor: "#9AC5F9B2",
    url: "",
  },
  {
    name: "Phụ Kiện",
    img: accessory,
    bgColor: "#E6DCDCB2",
    url: "",
  },
  {
    name: "Sắc Đẹp",
    img: bounty,
    bgColor: "#9C9AF9B2",
    url: "",
  },
];

const CategoryBar = () => {
  return (
    <div className="w-full rounded-[0.9375rem] bg-white py-3">
      <div className="no-scrollbar flex h-full w-full flex-row justify-evenly overflow-scroll">
        {categories.map((category, index) => (
          <div key={index} className="p-1">
            <Link href={category.url}>
              <div
                className={cn(
                  "relative mx-auto flex size-[4.5rem] items-center justify-center rounded-full",
                )}
              >
                <div
                  className="absolute h-full w-full rounded-full opacity-70 blur-[2px]"
                  style={{ backgroundColor: `${category.bgColor}` }}
                ></div>
                <Image
                  src={category.img}
                  alt={category.name}
                  className="relative h-[3.25rem] w-auto"
                />
              </div>
              <p className="mt-1 w-[6rem] text-center text-[0.875rem]">
                {category.name}
              </p>
            </Link>
          </div>
        ))}
      </div>
    </div>
  );
};

export default CategoryBar;
