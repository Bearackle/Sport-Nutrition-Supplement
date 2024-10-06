"use client";
import {
  Carousel,
  CarouselContent,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";
import * as React from "react";

type TProps = {
  children: React.ReactNode;
};

export function CustomCarousel({ children }: TProps) {
  return (
    <Carousel
      opts={{
        align: "start",
      }}
      className="mx-auto w-full"
    >
      <CarouselContent>{children}</CarouselContent>
      <CarouselPrevious className="-left-6" />
      <CarouselNext className="-right-6" />
    </Carousel>
  );
}
