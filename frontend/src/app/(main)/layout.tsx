export const runtime = "edge";

import { Footer } from "@/components/footer/Footer";
import { Header } from "@/components/header/Header";
import type { Metadata } from "next";
import "../globals.css";

export const metadata: Metadata = {
  title: {
    default: "4HProtein | Sport Nutrition Supplements",
    template: `%s | 4HProtein`,
  },
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
      <Header />
      {children}
      <Footer />
    </>
  );
}
