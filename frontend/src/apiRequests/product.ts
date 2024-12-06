import http from "@/lib/http";
import {
  AllProductsResType,
  ProductDetailResType,
  TopDealsResType,
} from "@/schemaValidations/product.schema";

const productApiRequest = {
  allProducts: (queryParams: string) => {
    return http.get<AllProductsResType>(`/collection/all?${queryParams}`);
  },
  categoryProducts: (category: string, queryParams: string) => {
    return http.get<AllProductsResType>(
      `/collection/category/${category}?${queryParams}`,
    );
  },
  topDeals: () => http.get<TopDealsResType>("/products/top-deals"),
  productDetail: (productId: string) =>
    http.get<ProductDetailResType>(`/products/${productId}`),
};

export default productApiRequest;
