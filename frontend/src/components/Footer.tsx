import { cn } from "@/lib/utils";
import logo from "../../public/logo.png";
import Image from "next/image";

export const Footer = () => {
  return (
    <footer className={cn("w-full bg-white space-y-8")}>
      <div className="w-full bg-[#066196] py-[0.625rem]">
        <div className="h-[1rem]"></div>
      </div>
      <div className={cn("max-w-[75rem] mx-auto")}>
        <div className={cn("flex flex-wrap gap-4")}>
          <div>
            <h2 className={cn("text-app-carbon text-normal font-bold")}>
              Thông tin cửa hàng
            </h2>
            <Image src={logo} alt="logo" className="size-40" />
            <p className={cn("text-app-carbon text-normal")}>
              <strong>Địa chỉ:</strong> 123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM
            </p>
          </div>
          <div>
            <h2 className={cn("text-app-carbon text-normal font-bold")}>
              Hỗ trợ khách hàng
            </h2>
          </div>
          <div>
            <h2 className={cn("text-app-carbon text-normal font-bold")}>
              Chính sách
            </h2>
          </div>
          <div>
            <h2 className={cn("text-app-carbon text-normal font-bold")}>
              Tổng đài hỗ trợ
            </h2>
          </div>
        </div>
      </div>
    </footer>
  );
};
