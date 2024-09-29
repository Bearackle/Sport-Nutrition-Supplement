import SideBar from "@/components/SideBar";
import { Metadata } from "next";

export const metadata: Metadata = {
  title: "4H | Thực phẩm thể hình chính hãng",
  description:
    "4H | Thương hiệu hàng đầu về sản phẩm dinh dưỡng thể thao, giúp bạn nâng cao hiệu suất và chăm sóc sức khỏe toàn diện.",
};

export default function Home() {
  return (
    <main className="mx-auto flex w-full max-w-[75rem] flex-row justify-around py-8">
      <SideBar />
      <div className="h-screen w-[52.5rem]"></div>
    </main>
  );
}
