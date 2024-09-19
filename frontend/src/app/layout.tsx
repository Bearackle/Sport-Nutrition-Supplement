export const runtime = "edge";
import { cn } from "@/lib/utils";
import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Sport Nutrition Supplements",
  description: "Sport Nutrition Supplements",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="vi">
      <body className={cn("flex w-full flex-col items-center")}>
      <div className="relative flex w-full max-w-[120rem] flex-col items-center">
          <main className="w-full overflow-hidden bg-app-silver">
            {children}
          </main>
        </div>
      </body>
    </html>
  );
}
