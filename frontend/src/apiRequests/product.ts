import http from "@/lib/http";
import {
  ProductDetailResType,
  TopDealsResType,
} from "@/schemaValidations/product.schema";

const productApiRequest = {
  topDeals: () => http.get<TopDealsResType>("/products/top-deals"),
  productDetail: (productId: string) =>
    http.get<ProductDetailResType>(`/products/${productId}`),
};

export default productApiRequest;
