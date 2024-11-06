import { TParamsOrderHistory } from "@/types/order-history";
import Image from "next/image";
import OrderCard from "./OrderCard";
import emptyBox from "/public/empty-box.png";

const data: TParamsOrderHistory | null = [
  {
    orderId: 1,
    products: [
      {
        productId: 1,
        productName: "Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)",
        variant: "Chocolate",
        productImage:
          "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
        quantity: 1,
        price: 1579000,
      },
      {
        productId: 1,
        productName: "Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)",
        variant: "Cream",
        productImage:
          "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
        quantity: 3,
        price: 1579000,
      },
    ],
    orderDate: "2024-11-02T02:48:00.000Z",
    totalAmount: 6316000,
    status: "Giao hàng thành công",
  },
];

const OrderHistorySection = () => {
  if (!data[0]) {
    return (
      <div className="mt-[0.75em] flex h-[30em] w-full flex-col items-center justify-center gap-[0.5em] rounded-[0.625em] bg-white">
        <Image
          src={emptyBox}
          alt="empty box"
          className="size-[10em] opacity-70"
        />
        <p className="text-center text-[1.25em] font-bold text-[#4a4f63]">
          Bạn chưa có đơn hàng nào
        </p>
      </div>
    );
  }
  return (
    <div className="mt-[0.75em] min-h-[30em] w-full rounded-[0.625em] bg-white">
      <div className="hidden w-full flex-row items-center justify-between border-b-[0.125em] border-solid px-[1em] py-[0.75em] text-center text-[1em] leading-[1.21] text-[#333] md:flex">
        <div className="shrink-0 basis-[27.5em]">Sản phẩm</div>
        <div className="shrink-0 basis-[7em]">Ngày đặt hàng</div>
        <div className="shrink-0 basis-[6.875em]">Tổng tiền</div>
        <div className="shrink-0 basis-[8em]">Trạng thái</div>
      </div>
      <div className="divide-y px-[1em]">
        <OrderCard order={data[0]} />
        <OrderCard order={data[0]} />
      </div>
    </div>
  );
};

export default OrderHistorySection;
