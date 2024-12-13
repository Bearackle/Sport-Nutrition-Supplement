import { Dispatch, SetStateAction } from "react";
import { MethodSelection } from "./MethodSelection";
import hcmCity from "/public/cart/hcm-city.svg";
import vietnam from "/public/cart/vietnam.svg";

const SHIPPING_METHODS = [
  {
    icon: hcmCity,
    label: "Giao hàng nhanh (trong khu vực thành phố Hồ Chí Minh)",
    method: "TPHCM",
  },
  {
    icon: vietnam,
    label: "Giao hàng tiêu chuẩn (trong cả nước)",
    method: "VN",
  },
];

type TProps = {
  shippingMethod: string;
  setShippingMethod: Dispatch<SetStateAction<string>>;
};

export const OrderShippingMethod = ({
  shippingMethod,
  setShippingMethod,
}: TProps) => {
  return (
    <MethodSelection
      method={shippingMethod}
      setMethod={setShippingMethod}
      METHODS={SHIPPING_METHODS}
      title="Phương thức vận chuyển"
    />
  );
};
