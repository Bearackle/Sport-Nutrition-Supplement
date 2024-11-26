import http from "@/lib/http";

const productApiRequest = {
  topDeals: () => http.get("/product/top-deals"),
};

export default productApiRequest;
