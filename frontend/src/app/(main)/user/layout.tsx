"use client";
import React from "react";
import { cn } from "@/lib/utils";
import { usePathname } from "next/navigation";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { Avatar, AvatarFallback } from "@/components/ui/avatar";

// ** Import Icons
import profileIcon from "/public/profile-icon.png";
import billIcon from "/public/bill-icon.png";
import locationIcon from "/public/location-icon.png";
import Image from "next/image";

const routeMap: Record<string, string> = {
  "/user/information": "Thông tin cá nhân",
  "/user/bill-history": "Lịch sử đơn hàng",
  "/user/address": "Quản lý sổ địa chỉ",
};

const tabs = [
  {
    href: "/user/information",
    label: "Thông tin cá nhân",
    icon: profileIcon,
  },
  {
    href: "/user/bill-history",
    label: "Lịch sử đơn hàng",
    icon: billIcon,
  },
  {
    href: "/user/address",
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

  const stringToColor = (string: string) => {
    let hash = 0;
    let i;

    /* eslint-disable no-bitwise */
    for (i = 0; i < string.length; i += 1) {
      hash = string.charCodeAt(i) + ((hash << 5) - hash);
    }

    let color = "#";

    for (i = 0; i < 3; i += 1) {
      const value = (hash >> (i * 8)) & 0xff;
      color += `00${value.toString(16)}`.slice(-2);
    }
    /* eslint-enable no-bitwise */

    return color;
  };

  const getContrastingColor = (hex: string): string => {
    hex = hex.replace(/^#/, "");
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    return luminance > 0.5 ? "#000000" : "#FFFFFF";
  };

  const stringAvatar = (name: string) => {
    return {
      bgColor: stringToColor(name),
      textColor: getContrastingColor(stringToColor(name)),
      children: `${name.split(" ")[0][0]}${name.split(" ")[1][0]}`,
    };
  };
  return (
    <div className={cn("mx-auto w-full max-w-[75rem] py-12")}>
      <Breadcrumb className="px-[0.625rem]">
        <BreadcrumbList>
          <BreadcrumbItem>
            <BreadcrumbLink href="/">Trang chủ</BreadcrumbLink>
          </BreadcrumbItem>
          <BreadcrumbSeparator />
          <BreadcrumbItem>
            <BreadcrumbLink href="/user/information">Người dùng</BreadcrumbLink>
          </BreadcrumbItem>
          <BreadcrumbSeparator />
          <BreadcrumbItem>{routeMap[pathname]}</BreadcrumbItem>
        </BreadcrumbList>
      </Breadcrumb>
      <div
        className={cn(
          "mt-4 flex flex-row items-start justify-between px-[0.625rem]",
        )}
      >
        <div className={cn("w-[17.75rem]")}>
          <div
            className={cn(
              "flex h-[11rem] w-full flex-col items-center justify-center rounded-[0.625rem]",
            )}
            style={{
              background:
                "linear-gradient(135deg, rgba(66,108,230,1) 0%, rgba(45,92,209,1) 50%, rgba(19,62,192,1) 100%)",
            }}
          >
            <Avatar
              className={cn("size-16")}
              style={{
                backgroundColor: `${stringAvatar("Lê Quốc Hưng").bgColor}`,
              }}
            >
              <AvatarFallback
                className={cn("text-[1.25rem]")}
                style={{ color: `${stringAvatar("Lê Quốc Hưng").textColor}` }}
              >
                {stringAvatar("Lê Quốc Hưng").children}
              </AvatarFallback>
            </Avatar>
            <p
              className={cn(
                "mb-1 mt-1.5 text-[0.9375rem] capitalize leading-[1.21] text-white",
              )}
            >
              Lê Quốc Hưng
            </p>
            <p className={cn("text-[0.875rem] leading-[1.21] text-white")}>
              0999555666
            </p>
          </div>
          <div
            className={cn("mt-5 w-full divide-y rounded-[0.625rem] bg-white")}
          >
            {tabs.map((tab, index) => (
              <div
                key={index}
                className={cn("relative flex flex-row items-center p-3")}
              >
                <Image
                  src={tab.icon}
                  alt={tab.label}
                  className={cn("size-8")}
                />
                <span className={cn("", pathname === tab.href ? "" : "")}>
                  {tab.label}
                </span>
              </div>
            ))}
          </div>
        </div>
        <div className={cn("w-[55rem]")}>{children}</div>
      </div>
    </div>
  );
}
