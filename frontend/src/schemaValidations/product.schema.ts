import { z } from "zod";

export const TopDealsRes = z.array(
  z.object({
    productId: z.number(),
    productName: z.string(),
    image: z.array(
      z.object({
        imageId: z.number(),
        imageUrl: z.string(),
        publicId: z.string(),
        createAt: z.string(),
      }),
    ),
    price: z.number(),
    sale: z.number(),
    priceAfterSale: z.number(),
  }),
);

export type TopDealsResType = z.TypeOf<typeof TopDealsRes>;

export const ProductDetailRes = z.object({
  productId: z.number(),
  productName: z.string(),
  description: z.string(),
  shortDescription: z.array(z.string()),
  price: z.number(),
  sale: z.number(),
  priceAfterSale: z.number(),
  image: z.array(
    z.object({
      imageId: z.number(),
      imageUrl: z.string(),
      publicId: z.string(),
      createAt: z.string(),
    }),
  ),
  rating: z.number(),
  reviews: z.number(),
  stock: z.number(),
  categories: z.array(z.string()),
});

export type ProductDetailResType = z.TypeOf<typeof ProductDetailRes>;
