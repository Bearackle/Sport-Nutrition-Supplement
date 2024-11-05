import { formatPhoneNumber } from "@/lib/utils";
import { TParamsAddress } from "@/types/address-list";
import EditAddressModal from "@/components/user/addresses/EditAddressModal";

type TProps = {
  address: TParamsAddress;
};

const AddressCard = ({ address }: TProps) => {
  return (
    <div className="flex w-full flex-row gap-2 px-4 py-3">
      <div className="grow">
        <div className="flex w-full flex-row gap-4 text-base font-medium text-[#333]">
          <div>{address.name}</div>
          <div className="h-6 w-px bg-[#333]"></div>
          <div>{formatPhoneNumber(address.phone)}</div>
        </div>
        <div className="font-normal text-[#8C8F8D]">{address.address}</div>
      </div>
      <div className="flex flex-row items-center gap-2 text-[0.875rem] leading-[1.21]">
        <EditAddressModal address={address} />
        <div className="h-6 w-px bg-black"></div>
        <button className="text-[#C11616]">Xóa</button>
      </div>
    </div>
  );
};

export default AddressCard;
