"use client";
import { Avatar, AvatarFallback } from "@/components/ui/avatar";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { cn, getContrastingColor, stringToColor } from "@/lib/utils";
import Image from "next/image";
import { usePathname, useRouter } from "next/navigation";
import React from "react";

// ** Import Icons
import exitIcon from "/public/exit-icon.png";
import locationIcon from "/public/location-icon.png";
import orderIcon from "/public/order-icon.png";
import profileIcon from "/public/profile-icon.png";

const routeMap: Record<string, string> = {
  "/user/profile": "Thông tin cá nhân",
  "/user/order-history": "Lịch sử đơn hàng",
  "/user/addresses": "Quản lý sổ địa chỉ",
};

const tabs = [
  {
    href: "/user/profile",
    label: "Thông tin cá nhân",
    icon: profileIcon,
  },
  {
    href: "/user/order-history",
    label: "Lịch sử đơn hàng",
    icon: orderIcon,
  },
  {
    href: "/user/addresses",
    label: "Quản lý sổ địa chỉ",
    icon: locationIcon,
  },
];

export default function UserLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  const pathname = usePathname();
  const router = useRouter();

  const stringAvatar = (name: string) => {
    return {
      bgColor: stringToColor(name),
      textColor: getContrastingColor(stringToColor(name)),
      children: `${name.split(" ")[0][0]}${name.split(" ")[1][0]}`,
    };
  };
  return (
    <div
      className={cn(
        "mx-auto w-full max-w-[95%] py-12 xl:max-w-[75rem]",
        "text-[16px] md:text-[10px] lg:text-[13px] xl:text-[16px]",
      )}
    >
      <Breadcrumb className="md:px-[4.5%] xl:px-[0.625em]">
        <BreadcrumbList>
          <BreadcrumbItem>
            <BreadcrumbLink href="/" className="text-[0.875em]">
              Trang chủ
            </BreadcrumbLink>
          </BreadcrumbItem>
          <BreadcrumbSeparator />
          <BreadcrumbItem>
            <BreadcrumbLink href="/user/profile" className="text-[0.875em]">
              Người dùng
            </BreadcrumbLink>
          </BreadcrumbItem>
          <BreadcrumbSeparator />
          <BreadcrumbItem className="text-[0.875em]">
            {routeMap[pathname]}
          </BreadcrumbItem>
        </BreadcrumbList>
      </Breadcrumb>
      <div
        className={cn(
          "mt-4 flex flex-col items-start justify-between gap-y-4 px-[0.625em] md:flex-row md:justify-evenly xl:justify-between",
        )}
      >
        <div className={cn("w-full md:w-[17.75em]")}>
          <div
            className={cn(
              "flex h-[11em] w-full flex-col items-center justify-center rounded-[0.625em]",
            )}
            style={{
              background:
                "linear-gradient(135deg, rgba(66,108,230,1) 0%, rgba(45,92,209,1) 50%, rgba(19,62,192,1) 100%)",
            }}
          >
            <Avatar
              className={cn("size-[4em]")}
              style={{
                backgroundColor: `${stringAvatar("Lê Quốc Hưng").bgColor}`,
              }}
            >
              <AvatarFallback
                className={cn("text-[1.375em]")}
                style={{ color: `${stringAvatar("Lê Quốc Hưng").textColor}` }}
              >
                {stringAvatar("Lê Quốc Hưng").children}
              </AvatarFallback>
            </Avatar>
            <p
              className={cn(
                "mb-[0.25em] mt-[0.375em] text-[0.9375em] capitalize leading-[1.21] text-white",
              )}
            >
              Lê Quốc Hưng
            </p>
            <p className={cn("text-[0.875em] leading-[1.21] text-white")}>
              0999555666
            </p>
          </div>
          <div
            className={cn(
              "mt-[1.25em] w-full divide-y rounded-[0.625em] bg-white",
            )}
          >
            {tabs.map((tab, index) => (
              <button
                key={index}
                onClick={() => router.push(tab.href)}
                className={cn(
                  "relative flex w-full flex-row items-center p-[0.75em]",
                )}
              >
                <Image
                  src={tab.icon}
                  alt={tab.label}
                  className={cn("size-[2em]")}
                />
                <div
                  className={cn(
                    "ml-[1em] text-[0.875em] font-medium",
                    pathname === tab.href ? "text-[#1250DC]" : "text-[#333]",
                  )}
                >
                  {tab.label}
                </div>
                <div className={cn("absolute right-[5%]")}>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    strokeWidth={1.75}
                    stroke="currentColor"
                    className={cn(
                      "size-[1.5em]",
                      pathname === tab.href
                        ? "stroke-[#1250DC]"
                        : "stroke-[#333]",
                    )}
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      d="m8.25 4.5 7.5 7.5-7.5 7.5"
                    />
                  </svg>
                </div>
              </button>
            ))}
            <button
              className={cn(
                "relative flex w-full flex-row items-center p-[0.75em]",
              )}
            >
              <Image
                src={exitIcon}
                alt="Log out"
                className={cn("size-[2em]")}
              />
              <div
                className={cn(
                  "ml-[1em] text-[0.875em] font-medium text-[#333]",
                )}
              >
                Đăng xuất
              </div>
              <div className={cn("absolute right-[5%]")}>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  strokeWidth={1.75}
                  stroke="#333"
                  className={cn("size-[1.5em]")}
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="m8.25 4.5 7.5 7.5-7.5 7.5"
                  />
                </svg>
              </div>
            </button>
          </div>
        </div>
        <div className={cn("w-full md:w-[55em]")}>{children}</div>
      </div>
    </div>
  );
}