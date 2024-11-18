import z from "zod";

export const AccountRes = z
  .object({
    userId: z.number(),
    name: z.string(),
    email: z.string(),
    phone: z.string().nullable(),
  })
  .strict();

export type AccountResType = z.TypeOf<typeof AccountRes>;

export const UpdateMeBody = z.object({
  name: z.string().trim().min(2).max(256),
});

export type UpdateMeBodyType = z.TypeOf<typeof UpdateMeBody>;
