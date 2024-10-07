type TProps = {
  index: number;
  id: number;
  image: string;
  name: string;
  rating: number;
  price: number;
  discount: number;
  priceAfterDiscount: number;
};

const ProductCard = ({
  index,
  id,
  image,
  name,
  rating,
  price,
  discount,
  priceAfterDiscount,
}: TProps) => {
  return (
    <div>
      <div></div>
    </div>
  );
};

export default ProductCard;
