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
      <div className="mx-auto w-full max-w-[75rem] space-y-4 py-8">
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
        <div className="flex w-full flex-row justify-around pt-8">
          <FilterBar />
          <div className="w-[54.5rem]">
            <ProductSection />
          </div>
        </div>
      </div>
    </div>
  );
};

export default page;
