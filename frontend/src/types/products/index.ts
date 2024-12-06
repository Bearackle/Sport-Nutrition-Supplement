export type TParamsProductCard = {
  productId: number;
  productName: string;
  price: number;
  sale: number;
  priceAfterSale: number;
  image: {
    imageId: number;
    imageUrl: string;
    publicId: string;
    createAt: string;
  }[];
};
