import { cn } from "@/lib/utils";
import Image from "next/image";
import logo from "../../../public/logo.png";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faFacebook, faInstagram } from "@fortawesome/free-brands-svg-icons";
import { faEnvelope } from "@fortawesome/free-regular-svg-icons";
import { Subscription } from "@/components/footer/Subscription";
import Link from "next/link";

export const Footer = () => {
  return (
    <footer className={cn("leaading-[1.21] w-full space-y-8 bg-white")}>
      <div
        className="w-full py-3"
        style={{
          background:
            "linear-gradient(180deg, rgba(63,133,233,1) 0%, rgba(48,116,225,1) 50%, rgba(37,105,222,1) 100%)",
        }}
      >
        <div className={cn("mx-auto flex max-w-[75rem] justify-between")}>
          <div className={cn("flex flex-row items-center gap-4 pl-4")}>
            <FontAwesomeIcon
              icon={faFacebook}
              color="white"
              width={36}
              height={36}
            />
            <FontAwesomeIcon
              icon={faInstagram}
              color="white"
              width={40}
              height={40}
            />
          </div>
          <div className={cn("flex flex-row items-center gap-12")}>
            <div className={cn("flex flex-row items-center gap-4")}>
              <FontAwesomeIcon icon={faEnvelope} color="white" height={40} />
              <p className={cn("text-[0.875rem] text-white")}>
                Bạn muốn nhận khuyến mãi đặc biệt?
                <br />
                Đăng ký ngay.
              </p>
            </div>
            <Subscription />
          </div>
        </div>
      </div>
      <div className={cn("mx-auto max-w-[75rem]")}>
        <div className={cn("grid grid-cols-2 grid-rows-2 gap-8")}>
          <div className={cn("space-y-1")}>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Thông tin cửa hàng
            </h2>
            <Image src={logo} alt="logo" className="size-32" />
            <p className={cn("text-[0.875rem] text-app-carbon")}>
              <strong>Địa chỉ:</strong> 123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM
            </p>
            <p className={cn("text-[0.875rem] text-app-carbon")}>
              <strong>Số điện thoại:</strong> 033 330 3802
            </p>
            <p className={cn("text-[0.875rem] text-app-carbon")}>
              <strong>Email:</strong> 4hprotein@gmail.com
            </p>
          </div>
          <div className={cn("space-y-1")}>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Hỗ trợ khách hàng
            </h2>
            <ul className={cn("space-y-1")}>
              <li>
                <Link href="#">Hướng dẫn mua hàng</Link>
              </li>
              <li>
                <Link href="#">Hướng dẫn thanh toán</Link>
              </li>
              <li>
                <Link href="#">Hướng dẫn đổi trả hàng, hoàn tiền</Link>
              </li>
            </ul>
          </div>
          <div className={cn("space-y-1")}>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Tổng đài hỗ trợ
            </h2>
            <p className={cn("text-[0.875rem]")}>
              Hotline: <strong>033.330.3802</strong>
            </p>
          </div>
          <div className={cn("space-y-1")}>
            <h2 className={cn("text-base font-bold text-app-carbon")}>
              Chính sách
            </h2>
            <ul className={cn("space-y-1")}>
              <li>
                <Link href="#">Quy định sử dụng</Link>
              </li>
              <li>
                <Link href="#">Chính sách Vận Chuyển</Link>
              </li>
              <li>
                <Link href="#">Chính sách Bảo Mật</Link>
              </li>
              <li>
                <Link href="#">Chính sách Đổi Trả Hàng</Link>
              </li>
              <li>
                <Link href="#">
                  Chính sách bảo vệ thông tin cá nhân của người tiêu dùng
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  );
};
