import { cn } from "@/lib/utils";

export const ProductReviews = () => {
  return (
    <div
      className={cn(
        "relative mx-auto mt-8 w-[95%] select-none justify-between overflow-hidden rounded-[0.75rem] bg-white p-6",
      )}
    >
      <h3 className={cn("text-[1.25rem] font-bold uppercase leading-[1.21]")}>
        Đánh giá sản phẩm
      </h3>
      <div className="mt-4 text-[#333]">
        Tính năng đang được phát triển, vui lòng quay lại sau.
      </div>
    </div>
  );
};
