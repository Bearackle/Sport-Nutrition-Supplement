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
          "https://s3-alpha-sig.figma.com/img/12e6/74fb/2c212ef3f0d69e729019abe60b526a57?Expires=1730678400&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=aSngsLJXe0muWkDFSQczpu5oMZXnLNW145ATlBBGZLKBFdKD~pJeY-VX8FxKbxly50Lnw5pSO1AQms4RuWx5nQeP5vc0dX0JziKaY~ZsVZFZRkN-1WyAf-qdHMeADG8zXEncbD5nzPf~96Ud70~-jZDulc-hAzv8QDYCYYMZfA8rox5ZBK4z3EvXrlMbpbCD4assDIz~ZX3~XtUqhMQc29SZ8rCcNB-F~MPvpF0Tmq7IVYMlfd-mcJUCYaHwuI3zixn0C6csOLleVozu5d0szMYDZBrEDFXaiQW-4~mwlEQUK5HsvvELY3ZRvue9douWsBDuMvgoEDR7kY5E8JUdhw__",
        quantity: 1,
        price: 1579000,
      },
      {
        productId: 1,
        productName: "Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)",
        variant: "Cream",
        productImage:
          "https://s3-alpha-sig.figma.com/img/12e6/74fb/2c212ef3f0d69e729019abe60b526a57?Expires=1730678400&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=aSngsLJXe0muWkDFSQczpu5oMZXnLNW145ATlBBGZLKBFdKD~pJeY-VX8FxKbxly50Lnw5pSO1AQms4RuWx5nQeP5vc0dX0JziKaY~ZsVZFZRkN-1WyAf-qdHMeADG8zXEncbD5nzPf~96Ud70~-jZDulc-hAzv8QDYCYYMZfA8rox5ZBK4z3EvXrlMbpbCD4assDIz~ZX3~XtUqhMQc29SZ8rCcNB-F~MPvpF0Tmq7IVYMlfd-mcJUCYaHwuI3zixn0C6csOLleVozu5d0szMYDZBrEDFXaiQW-4~mwlEQUK5HsvvELY3ZRvue9douWsBDuMvgoEDR7kY5E8JUdhw__",
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
      <div className="mt-3 flex h-[30rem] w-full flex-col items-center justify-center gap-2 rounded-[0.625rem] bg-white">
        <Image
          src={emptyBox}
          alt="empty box"
          className="size-[10rem] opacity-70"
        />
        <p className="text-center text-[1.25rem] font-bold text-[#4a4f63]">
          Bạn chưa có đơn hàng nào
        </p>
      </div>
    );
  }
  return (
    <div className="mt-3 min-h-[30rem] w-full rounded-[0.625rem] bg-white">
      <div className="flex w-full flex-row items-center justify-between border-b-[2px] border-solid px-4 py-3 text-center text-base leading-[1.21] text-[#333]">
        <div className="shrink-0 basis-[27.5rem]">Sản phẩm</div>
        <div className="shrink-0 basis-[7rem]">Ngày đặt hàng</div>
        <div className="shrink-0 basis-[6.875rem]">Tổng tiền</div>
        <div className="shrink-0 basis-[8rem]">Trạng thái</div>
      </div>
      <div className="divide-y px-4">
        <OrderCard order={data[0]} />
        <OrderCard order={data[0]} />
      </div>
    </div>
  );
};

export default OrderHistorySection;
