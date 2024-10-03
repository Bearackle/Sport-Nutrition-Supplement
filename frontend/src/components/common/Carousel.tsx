"use client";
import { cn } from "@/lib/utils";
import { Children } from "react";
import { useSpringCarousel } from "react-spring-carousel";

type TProps = {
  children: React.ReactNode;
  itemsPerSlide: number;
  buttonStyle?: string;
};

export default function Carousel({
  children,
  itemsPerSlide,
  buttonStyle,
}: TProps) {
  const { carouselFragment, slideToPrevItem, slideToNextItem } =
    useSpringCarousel({
      itemsPerSlide: itemsPerSlide,
      withLoop: true,
      gutter: 0,
      items: Children.map(Children.toArray(children), (child, i) => ({
        id: i,
        renderItem: child,
      })),
    });

  return (
    <div className="relative flex flex-row overflow-hidden">
      <button
        onClick={slideToPrevItem}
        className={cn(buttonStyle, buttonStyle && "left-0")}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          strokeWidth={2.5}
          stroke="#75818F"
          className="h-[0.96rem] w-[0.96rem] md:h-[1.2rem] md:w-[1.2rem] lg:h-6 lg:w-6"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M15.75 19.5L8.25 12l7.5-7.5"
          />
        </svg>
      </button>
      <div className="block overflow-hidden">{carouselFragment}</div>
      <button
        onClick={slideToNextItem}
        className={cn(buttonStyle, buttonStyle && "right-0")}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          strokeWidth={2.5}
          stroke="#75818F"
          className="h-[0.96rem] w-[0.96rem] md:h-[1.2rem] md:w-[1.2rem] lg:h-6 lg:w-6"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M8.25 4.5l7.5 7.5-7.5 7.5"
          />
        </svg>
      </button>
    </div>
  );
}
