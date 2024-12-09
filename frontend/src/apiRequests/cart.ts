import http from "@/lib/http";
import { AddProductToCartBodyType, CartResType } from "@/types/cart";

const cartApiRequests = {
  getCartProducts: () => http.get<CartResType>("/cart/all"),
  addProductToCart: (body: AddProductToCartBodyType) =>
    http.post<CartResType>("/cart/item", body),
};

export default cartApiRequests;
