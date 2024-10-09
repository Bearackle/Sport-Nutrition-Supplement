import { cn } from "@/lib/utils";
import Image from "next/image";
import logo from "../../public/logo.png";

export const Footer = () => {
  return (
    <footer className={cn("w-full space-y-8 bg-white")}>
      <div
        className="w-full py-[0.625rem]"
        style={{
          background:
            "linear-gradient(180deg, rgba(63,133,233,1) 0%, rgba(48,116,225,1) 50%, rgba(37,105,222,1) 100%)",
        }}
      >
        <div className="h-[1rem]"></div>
      </div>
      <div className={cn("mx-auto max-w-[75rem]")}>
        <div className={cn("flex flex-wrap gap-4")}>
          <div>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Thông tin cửa hàng
            </h2>
            <Image src={logo} alt="logo" className="size-40" />
            <p className={cn("text-base text-app-carbon")}>
              <strong>Địa chỉ:</strong> 123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM
            </p>
          </div>
          <div>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Hỗ trợ khách hàng
            </h2>
          </div>
          <div>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Chính sách
            </h2>
          </div>
          <div>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Tổng đài hỗ trợ
            </h2>
          </div>
        </div>
      </div>
    </footer>
  );
};
