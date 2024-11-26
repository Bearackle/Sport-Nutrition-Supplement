import { CustomCarousel } from "../common/CustomCarousel";
import { CarouselItem } from "../ui/carousel";
import HomeProductCard from "./HomeProductCard";

const data = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  image:
    "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
  name: "RULE 1 PROTEIN (ĐỎ) WHEY ISOLATE TĂNG CƠ BẮP - 5 LBS",
  rating: 4,
  price: 1950000,
  discount: 20,
  priceAfterDiscount: 1579000,
}));

const TopDealListSection = () => {
  if (data.length <= 3)
    return (
      <>
        {data.map((product, index) => (
          <HomeProductCard key={index} index={index} {...product} />
        ))}
      </>
    );

  return (
    <CustomCarousel>
      {data.map((product, index) => (
        <CarouselItem
          key={product.id}
          className="flex basis-full justify-center xs:basis-1/2 ml:basis-1/3"
        >
          <HomeProductCard index={index} {...product} />
        </CarouselItem>
      ))}
    </CustomCarousel>
  );
};

export default TopDealListSection;
