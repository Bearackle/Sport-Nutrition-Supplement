// ** Import UI
import FilterBar from "@/components/product-list/FilterBar";
import ProductCategoryList from "@/components/product-list/ProductCategoryList";
import ProductSection from "@/components/product-list/ProductSection";
import { ProductListBreadcrumb } from "@/components/product-list/ProductListBreadcrumb";

const page = ({ params }: { params: { category: string } }) => {
  return (
    <div className="relative w-full leading-[1.21]">
      <div className="mx-auto w-full max-w-[75rem] space-y-4 py-4 xs:py-8 xl:w-full">
        <div className="mx-auto w-[95%] max-w-[75rem] space-y-4 xl:w-full">
          <ProductListBreadcrumb params={params} />
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
