"use client";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { cn } from "@/lib/utils";
import { zodResolver } from "@hookform/resolvers/zod";
import { DialogClose } from "@radix-ui/react-dialog";
import { useForm } from "react-hook-form";
import { z } from "zod";

const formSchema = z.object({
  address: z.string().min(1, { message: "Địa chỉ không được để trống" }),
});

const AddAddressModal = () => {
  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      address: "",
    },
  });

  function onSubmit(values: z.infer<typeof formSchema>) {
    // Do something with the form values.
    // ✅ This will be type-safe and validated.
    console.log(values);
  }
  return (
    <Dialog>
      <DialogTrigger className="text-[0.9375em] font-medium text-[#1250DC]">
        Thêm địa chỉ
      </DialogTrigger>
      <DialogContent
        className={cn(
          "p-6 md:p-4 lg:p-5 xl:p-6",
          "max-w-lg md:max-w-sm lg:max-w-md xl:max-w-lg",
          "gap-4 md:gap-2 lg:gap-3 xl:gap-4",
        )}
      >
        <DialogHeader>
          <DialogTitle className="text-[1.125rem] leading-none md:text-[0.703125rem] lg:text-[0.9140625rem] xl:text-[1.125rem]">
            Thêm địa chỉ
          </DialogTitle>
          <DialogDescription className="text-[0.875rem] md:text-[0.625rem] lg:text-[0.725rem] xl:text-[0.875rem]">
            Thêm địa chỉ cho đơn hàng của bạn.
          </DialogDescription>
        </DialogHeader>
        <Form {...form}>
          <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-2">
            <FormField
              control={form.control}
              name="address"
              render={({ field }) => (
                <FormItem>
                  <FormLabel className="text-[0.875rem] md:text-[0.625rem] lg:text-[0.725rem] xl:text-[0.875rem]">
                    Địa chỉ
                  </FormLabel>
                  <FormControl>
                    <Input
                      placeholder="Số nhà + Tên đường, Phường / Xã, Tỉnh / Thành phố"
                      className="text-[0.875rem] md:text-[0.625rem] lg:text-[0.725rem] xl:text-[0.875rem]"
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <div className="flex flex-row items-center justify-end gap-4">
              <DialogFooter className="sm:justify-start">
                <DialogClose asChild>
                  <Button
                    type="button"
                    variant="secondary"
                    className={cn(
                      "text-[0.875rem] md:text-[0.625rem] lg:text-[0.725rem] xl:text-[0.875rem]",
                      "leading-[1.25rem] md:leading-[0.78125rem] lg:leading-[1.015625rem] xl:leading-[1.25rem]",
                      "px-4 py-2 md:px-3 md:py-0.5 lg:py-1.5 xl:px-4 xl:py-2.5",
                    )}
                  >
                    Hủy
                  </Button>
                </DialogClose>
              </DialogFooter>
              <Button
                type="submit"
                className={cn(
                  "bg-[#1250DC] hover:bg-[#1250DC]/[0.9]",
                  "text-[0.875rem] md:text-[0.625rem] lg:text-[0.725rem] xl:text-[0.875rem]",
                  "leading-[1.25rem] md:leading-[0.78125rem] lg:leading-[1.015625rem] xl:leading-[1.25rem]",
                  "px-4 py-2 md:px-3 md:py-0.5 lg:py-1.5 xl:px-4 xl:py-2.5",
                )}
              >
                Xác nhận
              </Button>
            </div>
          </form>
        </Form>
      </DialogContent>
    </Dialog>
  );
};

export default AddAddressModal;
