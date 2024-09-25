"use client";
import Image from "next/image";
import React from "react";
import searchIcon from "/public/search-icon.svg";

export default function SearchInput() {
  const [searchQuery, setSearchQuery] = React.useState("");

  const onSearch = (e: React.FormEvent) => {
    e.preventDefault();
  };
  return (
    <form
      action=""
      className="flex w-[30rem] flex-row items-center rounded-[3.125rem] bg-white"
    >
      <input
        value={searchQuery}
        onChange={(e) => setSearchQuery(e.target.value)}
        placeholder="Nhập tên sản phẩm..."
        className="grow bg-transparent px-4 py-2 text-[0.875rem] focus:outline-none"
      />
      <button
        type="submit"
        className="mr-[0.15625rem] flex size-8 items-center justify-center rounded-[6.25rem] bg-[#B5D4F5]"
      >
        <Image src={searchIcon} alt="search" className="size-4" />
      </button>
    </form>
  );
}
