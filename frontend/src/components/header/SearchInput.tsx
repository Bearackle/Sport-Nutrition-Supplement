"use client";
import React from "react";

export default function SearchInput() {
  const [searchQuery, setSearchQuery] = React.useState("");

  const onSearch = (e: React.FormEvent) => {
    e.preventDefault();
  };
  return (
    <form action="">
      <input
        value={searchQuery}
        onChange={(e) => setSearchQuery(e.target.value)}
        placeholder="Nhập tên sản phẩm..."
        className="w-[15rem] rounded-[0.375rem] px-4 py-2 text-[0.875rem] focus:outline-none"
      />
    </form>
  );
}
