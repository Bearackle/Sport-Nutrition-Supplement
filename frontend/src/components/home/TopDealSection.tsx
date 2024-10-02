import Image from "next/image";
import HomeProductCard from "./HomeProductCard";
import saleIcon from "/public/sale-icon.svg";

const data = [
  {
    id: 2025151052197,
    image:
      "https://s3-alpha-sig.figma.com/img/12e6/74fb/2c212ef3f0d69e729019abe60b526a57?Expires=1728864000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=B6mHWBTG3mHNsoTIAaP310gqNaPysqZkXT1fA~Mg9PxuFG7UqLCXHDjyJKpCagoAcLs5FAOpiVYwZ0J--OS1jdiST1GBU5cdVSOUbn7h6xrcY-66N5UZLI3wKiecbwzL-TTC8nKJ32YLquSk4ZOKkWMcf-XY2e6ufTsGWQwLbintnBtC~vJtai8WtPFJz7SHB7b6LLH~cr7jFc832dhC48wstb6Z8id-EhocAXO-yDzHLHlEou~-7ShD5~AFl5zjDFhwRaD6GS9gpXGlVkkLQWzfbaDooav87G7~xUe~q3anIiuCn4cM6uhJYctJeOT3Bm2KP1KhMAP9tAypFF2AiA__",
    name: "RULE 1 PROTEIN (ĐỎ) WHEY ISOLATE TĂNG CƠ BẮP - 5 LBS",
    rating: 4,
    price: 1950000,
    discount: 20,
    priceAfterDiscount: 1579000,
  },
];

const TopDealSection = () => {
  return (
    <div className="w-full rounded-[0.9375rem] bg-white p-4">
      <h3 className="mb-2 flex flex-row items-center gap-1 text-[1.25rem] font-bold uppercase leading-[1.21] text-[#C11616]">
        <Image src={saleIcon} alt="top deal" className="size-8" />
        <span>TOP DEAL • SIÊU RẺ</span>
      </h3>
      <div className="flex w-full flex-row justify-around px-8">
        <HomeProductCard index={0} {...data[0]} />
        <HomeProductCard index={1} {...data[0]} />
        <HomeProductCard index={2} {...data[0]} />
      </div>
    </div>
  );
};

export default TopDealSection;
