export type CartResType = {
  cartId: number;
  userId: number;
  products: CartProductsType;
  combos: [] | null;
  isAvailable: boolean;
};

export type CartProductType = {
  cartItemId: number;
  productId: number;
  productName: string;
  image: string;
  priceAfterSale: number;
  price: number;
  variantId: number;
  variantName: string;
  stockQuantity?: number;
  quantity: number;
};

export type CartProductsType = CartProductType[];

export type AddProductToCartBodyType = {
  productId: number;
  variantId: number;
  comboId: number | null;
  quantity: number;
};
