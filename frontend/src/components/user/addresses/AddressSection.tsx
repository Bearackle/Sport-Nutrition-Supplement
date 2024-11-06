import { TParamsAddressList } from "@/types/address-list";
import Image from "next/image";
import AddAddressModal from "./AddAddressModal";
import AddressCard from "./AddressCard";
import noAddress from "/public/no-address.png";

const data: TParamsAddressList | null = [
  // {
  //   id: 1,
  //   name: "Nguyễn Văn A",
  //   phone: "0333303802",
  //   address: "123 Đường ABC, Quận XYZ, TP.HCM",
  // },
  // {
  //   id: 2,
  //   name: "Nguyễn Văn A",
  //   phone: "0333303802",
  //   address: "123 Đường ABC, Quận XYZ, TP.HCM",
  // },
];

const AddressSection = () => {
  if (!data[0]) {
    return (
      <div className="mt-[0.75em] flex h-[30em] w-full flex-col items-center justify-center gap-[0.5em] rounded-[0.625em] bg-white">
        <Image
          src={noAddress}
          alt="no address"
          className="size-[7.5em] opacity-70"
        />
        <p className="text-center text-[1.25em] font-bold text-[#4a4f63]">
          Bạn chưa thêm địa chỉ nào
        </p>

        <AddAddressModal />
      </div>
    );
  }
  return (
    <div className="mt-[0.75em] min-h-[30em] w-full divide-y rounded-[0.625em] bg-white">
      {data.map((address) => (
        <AddressCard key={address.id} address={address} />
      ))}
    </div>
  );
};

export default AddressSection;
