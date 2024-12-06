import { z } from "zod";

export const GetProductsBody = z.object({
  brands: z.string().array().optional(),
  category: z.string().array().optional(),
  page: z.number().optional(),
  priceFrom: z.string().optional(),
  priceTo: z.string().optional(),
  sortByPrice: z.string().optional(),
});

export type GetProductsBodyType = z.TypeOf<typeof GetProductsBody>;

export const ProductsMeta = z.object({
  current_page: z.number(),
  from: z.number().nullable(),
  last_page: z.number(),
  links: z.array(
    z.object({
      url: z.string().nullable(),
      label: z.string(),
      active: z.boolean(),
    }),
  ),
  path: z.string(),
  per_page: z.number(),
  to: z.number().nullable(),
  total: z.number(),
});

export type ProductsMetaType = z.TypeOf<typeof ProductsMeta>;

export const AllProductsRes = z.object({
  data: z.array(
    z.object({
      productId: z.number(),
      productName: z.string(),
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
    }),
  ),
  links: z.object({
    first: z.string().nullable(),
    last: z.string().nullable(),
    prev: z.string().nullable(),
    next: z.string().nullable(),
  }),
  meta: z.object({
    current_page: z.number(),
    from: z.number().nullable(),
    last_page: z.number(),
    links: z.array(
      z.object({
        url: z.string().nullable(),
        label: z.string(),
        active: z.boolean(),
      }),
    ),
    path: z.string(),
    per_page: z.number(),
    to: z.number().nullable(),
    total: z.number(),
  }),
});

export type AllProductsResType = z.TypeOf<typeof AllProductsRes>;

export const ProductsRes = z.array(
  z.object({
    productId: z.number(),
    productName: z.string(),
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
  }),
);

export type ProductsResType = z.TypeOf<typeof ProductsRes>;

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
  categoryId: z.number(),
  brandId: z.number(),
  images: z.array(z.string()),
  variants: z.array(
    z.object({
      variantId: z.number(),
      variantName: z.string(),
      stockQuantity: z.number(),
    }),
  ),
});

export type ProductDetailResType = z.TypeOf<typeof ProductDetailRes>;
