import EditAddressModal from "@/components/user/addresses/EditAddressModal";
import { formatPhoneNumber } from "@/lib/utils";
import { TParamsAddress } from "@/types/address-list";

type TProps = {
  address: TParamsAddress;
};

const AddressCard = ({ address }: TProps) => {
  return (
    <div className="flex w-full flex-row gap-[0.5em] px-[1em] py-[0.75em]">
      <div className="grow">
        <div className="flex w-full flex-col gap-x-[1em] text-[1em] font-medium text-[#333] md:flex-row">
          <div className="line-clamp-1 max-w-[20em]">{address.name}</div>
          <div className="h[1.5em] hidden w-px bg-[#333] md:block"></div>
          <div className="line-clamp-1 max-w-[20em]">
            {formatPhoneNumber(address.phone)}
          </div>
        </div>
        <div className="line-clamp-3 font-normal text-[#8C8F8D]">
          {address.address}
        </div>
      </div>
      <div className="flex flex-row items-center gap-[0.5em] text-[0.875em] leading-[1.21]">
        <EditAddressModal address={address} />
        <div className="h-[1.5em] w-px bg-black"></div>
        <button className="text-[#C11616]">Xóa</button>
      </div>
    </div>
  );
};

export default AddressCard;
