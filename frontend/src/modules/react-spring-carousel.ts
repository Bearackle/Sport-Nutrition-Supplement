declare module "react-spring-carousel" {
  import { ReactNode } from "react";

  interface CarouselItem {
    id: number | string;
    renderItem: ReactNode;
  }

  interface UseSpringCarouselProps {
    itemsPerSlide: number;
    withLoop?: boolean;
    gutter?: number;
    items: CarouselItem[];
  }

  interface UseSpringCarouselResult {
    carouselFragment: ReactNode;
    slideToPrevItem: () => void;
    slideToNextItem: () => void;
  }

  export function useSpringCarousel(
    props: UseSpringCarouselProps,
  ): UseSpringCarouselResult;
}
