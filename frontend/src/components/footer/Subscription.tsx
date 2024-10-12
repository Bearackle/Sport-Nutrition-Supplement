"use client";
import { useRouter } from "next/navigation";
import { cn } from "@/lib/utils";

export const Subscription = () => {
  const router = useRouter();

  return (
    <form
      onSubmit={() => router.push("/register")}
      className={cn(
        "rounded-[0.5rem] bg-white text-[0.875rem] leading-[1.21] text-[#333]",
      )}
    >
      <input
        type="text"
        name="subcription"
        id="subcription"
        placeholder="Nhập email"
        required
        className={cn("bg-transparent px-4 py-3 focus:outline-none")}
      />
      <button
        type="submit"
        className={cn(
          "border-l border-solid border-[#333]/30 p-2 text-[0.8rem] font-medium",
        )}
      >
        Đăng ký
      </button>
    </form>
  );
};
