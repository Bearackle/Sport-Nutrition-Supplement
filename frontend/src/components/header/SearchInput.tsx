"use client";
import React from "react";

export default function SearchInput() {
  const [searchQuery, setSearchQuery] = React.useState("");

  const onSearch = (e: React.FormEvent) => {
    e.preventDefault();
  };
  return (
    <form action="" className="w-[25rem] rounded-[3.125rem] bg-white">
      <input
        value={searchQuery}
        onChange={(e) => setSearchQuery(e.target.value)}
        placeholder="Nhập tên sản phẩm..."
        className="grow bg-transparent px-4 py-2 text-[0.875rem] focus:outline-none"
      />
      <button type="submit"></button>
    </form>
  );
}
