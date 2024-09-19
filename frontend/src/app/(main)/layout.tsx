export const runtime = "edge";

import type { Metadata } from "next";
import "../globals.css";
import { Footer } from "@/components/Footer";
import { Navbar } from "@/components/Navbar";

export const metadata: Metadata = {
  title: "Sport Nutrition Supplements",
  description: "Sport Nutrition Supplements",
};

export async function generateStaticParams() {
  return [{ lang: "en-US" }];
}

export default function MainLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <>
      <Navbar />
      {children}
      <Footer />
    </>
  );
}
