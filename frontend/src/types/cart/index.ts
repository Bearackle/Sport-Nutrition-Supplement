export type CartResType = {
  cartId: number;
  userId: number;
  products: {
    cartItemId: number;
    productId: number;
    productName: string;
    image: string;
    priceAfterSale: number;
    variantId: number;
    variantName: string;
    quantity: number;
  }[];
  combos: [] | null;
};

export type AddProductToCartBodyType = {
  cartId: number;
  productId: number;
  variantId: number;
  comboId: number | null;
  quantity: number;
};
