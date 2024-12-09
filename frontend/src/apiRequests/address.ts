import http from "@/lib/http";
import {
  AddressBodyType,
  AddressListResType,
  AddressResType,
} from "@/schemaValidations/address.schema";

const addressApiRequest = {
  getAddress: () => http.get<AddressListResType>("/address"),
  addAddress: (body: AddressBodyType) =>
    http.post<AddressResType>("/address", body),
  updateAddress: (addressId: number, body: AddressBodyType) =>
    http.post<AddressResType>(`/address/update/${addressId}`, body),
  deleteAddress: (addressId: number) => http.delete(`/address/${addressId}`),
};

export default addressApiRequest;
