import { ProductDescription } from "@/components/product-detail/ProductDescription";
import { ProductOverview } from "@/components/product-detail/ProductOverview";
import { ProductReviews } from "@/components/product-detail/ProductReviews";
import { cn } from "@/lib/utils";
// import { ProductDetailBreadcrumb } from "@/components/product-detail/ProductDetailBreadcrumb";

const data = {
  id: "1",
  image: [
    "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
    "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
    "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
    "https://bizweb.dktcdn.net/thumb/1024x1024/100/398/814/products/40395b14-a1c0-425b-8003-798cdda053e9.jpg?v=1672752142887",
    "https://bizweb.dktcdn.net/thumb/grande/100/398/814/products/z5892281336181-febfe30290debf1f356aa951ca51abc4.jpg?v=1727944519513",
    "https://bizweb.dktcdn.net/thumb/grande/100/398/814/products/z5892281336181-febfe30290debf1f356aa951ca51abc4.jpg?v=1727944519513",
  ],
  name: "Nutrex Plant Protein - Protein Thực Vật (1.2 LBS)",
  brand: {
    id: "nutrex",
    name: "Nutrex",
  },
  rating: 5,
  price: 1973750,
  priceAfterDiscount: 1579000,
  discount: 20,
  promotionInformation: [
    "Dùng mã TANGQUA để được Free quà tặng.",
    "Mua kèm giá Shock, tặng quà theo đơn hàng.",
    "Miễn 50% phí Ship (tối đa 50k) với đơn từ 500k.",
    "Miễn 100% phí Ship với đơn hàng trên 3500k.",
    "Tích lũy Hạng thành viên, chiết khấu hấp dẫn.",
  ],
  variants: [
    {
      id: "chocolate",
      name: "Chocolate",
      stockQuantity: 10,
    },
    {
      id: "cream",
      name: "Cream",
      stockQuantity: 15,
    },
    {
      id: "strawberry",
      name: "Strawberry",
      stockQuantity: 2,
    },
  ],
  shortDescription: [
    "20g Protein nguồn gốc thực vật",
    "20 loại axit amin, 9 axit amin thiết yếu",
    "Phát triển cơ bắp",
    "Không chứa Lactose và Gluten",
    "Không gây nổi mụn",
  ],
  description: `<p style="text-align:center;"><br></p>
    <img src="https://vuagym.com/wp-content/uploads/2022/06/plant-protein-0-desk-10-30-2000x.jpg" alt="Nutrex - Plant Protein (1.2 Lb) - plant protein 0 desk 10 30" style="height: auto;width: "/>
    <h1 style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;"><strong>Nutrex – Plant Protein</strong></span></h1>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Bạn thích sử dụng bột protein thực vật hoặc thuần chay nhưng bạn ngán ngẩm mùi vị không được ngon miệng và kết cấu khó chịu của chúng? Chúng tôi có thể đảm bảo với bạn rằng có sản phẩm tốt hơn… Chất lượng hơn. PLANT PROTEIN của chúng tôi mang đến hương vị thực sự dành cho người sành ăn, khả năng hòa tan tuyệt vời và kết cấu siêu mịn. Đây là loại đạm thực vật NGON NHẤT. Bạn sẽ không bao giờ tin rằng đó đều là tự nhiên.</span></p>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Ok… nó có vị ngon nhưng chất lượng có tốt không? Bạn nhận được 20g protein cho mỗi khẩu phần, lấy từ 4 nguồn thực vật khác nhau ở các tỷ lệ cụ thể bao gồm tất cả 20 axit amin và tất cả 9 axit amin thiết yếu. Bạn không cần phải lo lắng về cơ bắp của mình, chúng sẽ ổn thôi!</span></p>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">PLANT PROTEIN là bột protein thực vật duy nhất kết hợp ít chất béo và ít carb, protein chất lượng cao với hương vị GOURMET hấp dẫn và không thể cưỡng lại trong khi hoàn toàn không chứa protein động vật hoặc sữa cũng như bất kỳ hương vị nhân tạo hoặc chất làm ngọt nào.</span></p>
    <p style="text-align:justify;">&nbsp;</p>
    <p style="text-align:center;"></p>
    <img src="https://vuagym.com/wp-content/uploads/2022/06/65d702d3c12a7c640ea3eb5af86549e0.jpg" alt="Nutrex - Plant Protein (1.2 Lb) - 65d702d3c12a7c640ea3eb5af86549e0" style="height: auto;width: "/>
    <h2 style="text-align:justify;">&nbsp;</h2>
    <h2 style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 18px;font-family: Verdana, Geneva, sans-serif;">THÀNH PHẦN CHÍNH CỦA NUTREX PLANT PROTEIN</span></h2>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Trong mỗi liều dùng Nutrex Plant Protein 1.2lbs (tương đương 30g) chứa:</span></p>
    <ul>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">20g Protein: 100% Protein thực vật từ 4 nguồn: hạt bí ngô, đậu xanh, gạo lức, hoa hướng dương.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">20 loại axit amin: Trong đó có 9 loại axit amin thiết yếu, giúp thúc đẩy nhanh quá trình hình thành sợi cơ mới, giúp phục hồi các tổn thương cơ bắp nhanh hơn.</span></li>
    </ul>
    <h2 style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 18px;font-family: Verdana, Geneva, sans-serif;">TẠI SAO NÊN SỬ DỤNG NUTREX PLANT PROTEIN?</span></h2>
    <ul>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Thành phần Protein có nguồn gốc tự nhiên, chứa ít chất béo bão hòa và cholesterone so với sản phẩm bổ sung Whey động vật, tốt cho sức khỏe hệ tim mạch.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Chứa chất xơ hỗ trợ tiêu hóa và chất</span> <span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">chống oxy hóa.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Không chứa lactose và gluten để dễ tiêu hóa.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Không thêm đường và ít chất béo, không gây tích mỡ, giúp</span> <span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;"><strong>kiểm soát cân nặng </strong>hiệu quả.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Sản phẩm không gây nóng trong người và gây nổi mụn.</span></li>
    </ul>
    <h2 style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 18px;font-family: Verdana, Geneva, sans-serif;">CÁCH SỬ DỤNG NUTREX PLANT PROTEIN</span></h2>
    <ul>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Pha 1 muỗng sản phẩm với 180-200ml ml nước. Lắc đều đến khi bột tan hết và sử dụng ngay.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Có thể sử dụng vào bất kỳ thời điểm nào trong ngày, khi cảm thấy cơ thể cần bổ sung năng lượng.</span></li>
    </ul>
    <h2 style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 18px;font-family: Verdana, Geneva, sans-serif;">LƯU Ý</span></h2>
    <ul>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Pha sản phẩm với nước lạnh hoặc nước ở nhiệt độ thường. Tuyệt đối không sử dụng nước nóng vì nước ở nhiệt độ cao có thể làm biến đổi các chất có trong sản phẩm.</span></li>
    <li style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Sử dụng đúng liều lượng đã khuyến nghị.</span></li>
    </ul>
    <p style="text-align:justify;">&nbsp;</p>
    <p style="text-align:left;">&nbsp;</p>
    <p style="text-align:center;"></p>
    <img src="https://blog.priceplow.com/wp-content/uploads/nutrex-plant-protein-ingredients.png" alt="Nutrex Plant Protein: Vegan & Natural, yet Stevia-Free!" style="height: auto;width: "/>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;"><strong>Xin quý khách lưu ý:</strong></span><br><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Hình ảnh và Nutrition Facts chỉ mang tính chất tham khảo bởi Thành phần có thể khác nhau giữa các mùi vị &amp; phiên bản của sản phẩm, hoặc nhà sản xuất đã thay đổi mà shop chưa cập nhật kịp.</span></p>
    <p style="text-align:justify;"><span style="color: rgb(6,53,80);background-color: rgb(255,255,255);font-size: 14px;font-family: Verdana, Geneva, sans-serif;">Vui lòng liên hệ 4HProtein trước nếu quý khách cần xem phiên bản hiện đang có.</span>&nbsp;</p>`,
};

const page = ({ params }: { params: { id: string } }) => {
  console.log(params.id);

  const productOverviewProps = {
    id: data.id,
    image: data.image,
    name: data.name,
    brand: data.brand,
    rating: data.rating,
    price: data.price,
    priceAfterDiscount: data.priceAfterDiscount,
    discount: data.discount,
    promotionInformation: data.promotionInformation,
    variants: data.variants,
    shortDescription: data.shortDescription,
  };
  return (
    <div className="relative w-full leading-[1.21]">
      <div
        className={cn("mx-auto w-full max-w-[75rem] py-4 xs:py-8 xl:w-full")}
      >
        {/*<ProductDetailBreadcrumb categoryId={product.category} name={product.name} />*/}
        <ProductOverview {...productOverviewProps} />
        <ProductDescription description={data.description} />
        <ProductReviews />
      </div>
    </div>
  );
};

export default page;
