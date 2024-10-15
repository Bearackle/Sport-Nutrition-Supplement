// import { ProductDetailBreadcrumb } from "@/components/product-detail/ProductDetailBreadcrumb";

import { cn } from "@/lib/utils";

const page = ({ params }: { params: { id: string } }) => {
  console.log(params.id);
  return (
    <div className="relative w-full leading-[1.21]">
      <div className="mx-auto w-full max-w-[75rem] space-y-4 py-4 xs:py-8 xl:w-full">
        {/*<ProductDetailBreadcrumb categoryId={product.category} name={product.name} />*/}
        <div
          className={cn(
            "mx-auto flex w-[95%] flex-row justify-between rounded-[0.75rem] bg-white p-8",
          )}
        >
          <div className={cn("w-[22.5rem]")}>
            <div
              className={cn(
                "size-[22.5rem] overflow-hidden rounded-[0.625rem] border border-solid border-[#333]/30",
              )}
            ></div>
          </div>
          <div className={cn("w-[42.5rem]")}></div>
        </div>
      </div>
    </div>
  );
};

export default page;
