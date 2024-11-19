import AddressSection from "@/components/user/addresses/AddressSection";
import { cn } from "@/lib/utils";

export default function Page() {
  return (
    <div className="w-full">
      <h2 className={cn("text-[1em] font-bold leading-[1.21] text-[#333]")}>
        Quản lý sổ địa chỉ
      </h2>
      <AddressSection />
    </div>
  );
}