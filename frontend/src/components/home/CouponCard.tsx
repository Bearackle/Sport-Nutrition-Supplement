import Image from "next/image";
import coupon from "/public/home/coupon.svg";

type TProps = {
  title: string;
  shortDescription: Array<string>;
  conditionUrl: string;
  code: string;
};

const CouponCard = ({
  title,
  shortDescription,
  conditionUrl,
  code,
}: TProps) => {
  return (
    <div className="flex h-full w-[16.5rem] flex-row">
      <Image src={coupon} alt="coupon" className="h-full w-auto" />
      <div className="grow rounded-e-[1.25rem] bg-white">
        <strong className="px-1 text-[0.75rem] font-bold leading-[1.21] text-[#C11616]">
          {title}
        </strong>
        <ul>
          {shortDescription.map((description, index) => (
            <li
              key={index}
              className="ml-1 px-1 text-[0.6875rem] font-bold text-black"
            >
              {description}
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
};

export default CouponCard;
