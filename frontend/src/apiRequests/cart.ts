import http from "@/lib/http";
import { AddProductToCartBodyType, CartResType } from "@/types/cart";

const cartApiRequests = {
  getCartProducts: () => http.get<CartResType>("/cart/all"),
  addProductToCart: (body: AddProductToCartBodyType) =>
    http.post<CartResType>("/cart/item", body),
  updateProductQuantity: (cartProductId: number, quantity: number) =>
    http.patch(`/cart/item/${cartProductId}`, { quantity }),
  deleteProductFromCart: (cartItemId: number) =>
    http.delete(`/cart/item/${cartItemId}`),
};

export default cartApiRequests;
