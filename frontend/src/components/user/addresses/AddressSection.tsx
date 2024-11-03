import { TParamsAddressList } from "@/types/address-list";
import Image from "next/image";
import AddAddressModal from "./AddAddressModal";
import AddressCard from "./AddressCard";
import noAddress from "/public/no-address.png";

const data: TParamsAddressList | null = [
  {
    id: 1,
    name: "Nguyễn Văn A",
    phone: "0333303802",
    address: "123 Đường ABC, Quận XYZ, TP.HCM",
  },
  {
    id: 2,
    name: "Nguyễn Văn A",
    phone: "0333303802",
    address: "123 Đường ABC, Quận XYZ, TP.HCM",
  },
];

const AddressSection = () => {
  if (!data[0]) {
    return (
      <div className="mt-3 flex h-[30rem] w-full flex-col items-center justify-center gap-2 rounded-[0.625rem] bg-white">
        <Image
          src={noAddress}
          alt="no address"
          className="size-[7.5rem] opacity-70"
        />
        <p className="text-center text-[1.25rem] font-bold text-[#4a4f63]">
          Bạn chưa thêm địa chỉ nào
        </p>

        <AddAddressModal />
      </div>
    );
  }
  return (
    <div className="mt-3 min-h-[30rem] w-full divide-y rounded-[0.625rem] bg-white">
      {data.map((address) => (
        <AddressCard key={address.id} address={address} />
      ))}
    </div>
  );
};

export default AddressSection;
