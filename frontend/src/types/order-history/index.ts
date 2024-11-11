export type TParamsOrderHistory = {
  orderId: number;
  products: {
    productId: number;
    productName: string;
    variant: string;
    productImage: string;
    quantity: number;
    price: number;
  }[];
  orderDate: string;
  totalAmount: number;
  status: string;
}[];

export type TParamsOrder = {
  orderId: number;
  products: {
    productId: number;
    productName: string;
    variant: string;
    productImage: string;
    quantity: number;
    price: number;
  }[];
  orderDate: string;
  totalAmount: number;
  status: string;
};
