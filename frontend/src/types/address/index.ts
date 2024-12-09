export type AddAddressBodyType = {
  addressDetail: string;
};

export type AddressResType = {
  addressId: number;
  addressDetail: string;
};

export type AddressListResType = {
  addressId: number;
  addressDetail: string;
}[];

export type TParamsAddressList = {
  id: number;
  name: string;
  phone: string;
  address: string;
}[];

export type TParamsAddress = {
  id: number;
  name: string;
  phone: string;
  address: string;
};
