export const runtime = "edge";
import { roboto } from "@/lib/font";
import { cn } from "@/lib/utils";
import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "4H | Sport Nutrition Supplements",
  description: "4H | Sport Nutrition Supplements",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="vi">
      <body
        className={cn("flex w-full flex-col items-center", roboto.className)}
      >
        <div className="relative flex w-full max-w-[120rem] flex-col items-center">
          <main className="w-full overflow-hidden bg-[#F5F5FA]">
            {children}
          </main>
        </div>
      </body>
    </html>
  );
}
