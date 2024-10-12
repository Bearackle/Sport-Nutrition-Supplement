// ** Import UI
import FilterBar from "@/components/product/FilterBar";
import ProductCategoryList from "@/components/product/ProductCategoryList";
import ProductSection from "@/components/product/ProductSection";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";

const page = () => {
  return (
    <div className="relative w-full leading-[1.21]">
      <div className="mx-auto w-full max-w-[75rem] space-y-4 py-4 xs:py-8 xl:w-full">
        <div className="mx-auto w-[95%] max-w-[75rem] space-y-4 xl:w-full">
          <Breadcrumb className="px-[0.625rem]">
            <BreadcrumbList>
              <BreadcrumbItem>
                <BreadcrumbLink href="/">Trang chủ</BreadcrumbLink>
              </BreadcrumbItem>
              <BreadcrumbSeparator />
              <BreadcrumbItem className="text-black">
                Tất cả sản phẩm
              </BreadcrumbItem>
            </BreadcrumbList>
          </Breadcrumb>
          <h2 className="px-[0.625rem] text-[1.125rem] font-bold">
            Tất cả sản phẩm
          </h2>
          <ProductCategoryList />
        </div>
        <div className="flex w-full flex-row justify-around pt-4 xs:pt-8">
          <FilterBar />
          <div className="w-full xl:w-[54.5rem]">
            <ProductSection />
          </div>
        </div>
      </div>
    </div>
  );
};

export default page;
