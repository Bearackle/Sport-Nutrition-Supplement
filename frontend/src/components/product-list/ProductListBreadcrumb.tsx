"use client";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { useRouter } from "next/navigation";
import { IProductCategory, productCategories } from "@/data/category";

export const ProductListBreadcrumb = ({
  params,
}: {
  params: { category: string };
}) => {
  const router = useRouter();
  const categoryId = params.category;

  const findParentCategory = (
    categoryId: string,
    categories: IProductCategory[],
    parent: IProductCategory | null = null,
  ): IProductCategory | null => {
    for (const category of categories) {
      if (category.id === categoryId) {
        return parent;
      }
      if (category.children) {
        const parentCategory = findParentCategory(
          categoryId,
          category.children,
          category,
        );
        if (parentCategory) {
          return parentCategory;
        }
      }
    }
    return null;
  };

  const findCategoryById = (
    categoryId: string,
    categories: IProductCategory[],
  ): IProductCategory | null => {
    for (const category of categories) {
      if (category.id === categoryId) {
        return category;
      }
      if (category.children) {
        const foundCategory = findCategoryById(categoryId, category.children);
        if (foundCategory) {
          return foundCategory;
        }
      }
    }
    return null;
  };

  if (findCategoryById(categoryId, productCategories) === null) {
    router.push("/not-found");
    return null;
  }

  const parentCategory = findParentCategory(categoryId, productCategories);
  const category = findCategoryById(categoryId, productCategories);
  return (
    <>
      <Breadcrumb className="px-[0.625rem]">
        <BreadcrumbList>
          <BreadcrumbItem>
            <BreadcrumbLink href="/">Trang chủ</BreadcrumbLink>
          </BreadcrumbItem>
          {parentCategory ? (
            <>
              <BreadcrumbSeparator />
              <BreadcrumbItem>
                <BreadcrumbLink
                  href={`/products/${parentCategory.children?.[0].id}`}
                >
                  {parentCategory?.label}
                </BreadcrumbLink>
              </BreadcrumbItem>
              <BreadcrumbSeparator />
              <BreadcrumbItem className="text-black">
                {findCategoryById(categoryId, productCategories)?.label}
              </BreadcrumbItem>
            </>
          ) : (
            <>
              <BreadcrumbSeparator />
              <BreadcrumbItem className="text-black">
                {category?.label}
              </BreadcrumbItem>
            </>
          )}
        </BreadcrumbList>
      </Breadcrumb>
      <h2 className="px-[0.625rem] text-[1.125rem] font-bold">
        {category?.label}
      </h2>
    </>
  );
};
