"use client";

// ** Import next
import Image from "next/image";
import {
  ReadonlyURLSearchParams,
  usePathname,
  useRouter,
  useSearchParams,
} from "next/navigation";

// ** Import react
import {
  ChangeEvent,
  ComponentPropsWithoutRef,
  ReactNode,
  useEffect,
  useState,
} from "react";

// ** Import ui
import { cn } from "@/lib/utils";
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "../ui/accordion";
import filterIcon from "/public/filter.svg";

const categories = ["Whey Protein", "Mass Gainer", "EAA-BCAA", "Pre-Workout"];

const prices = [
  {
    name: "Giá dưới 500.000₫",
    priceTo: 500000,
  },
  {
    name: "500.000₫ - 1.000.000₫",
    priceFrom: 500000,
    priceTo: 1000000,
  },
  {
    name: "1.000.000₫ - 1.500.000₫",
    priceFrom: 1000000,
    priceTo: 1500000,
  },
  {
    name: "1.500.000₫ - 2.000.000₫",
    priceFrom: 1500000,
    priceTo: 2000000,
  },
  {
    name: "2.000.000₫ - 2.500.000₫",
    priceFrom: 2000000,
    priceTo: 2500000,
  },
  {
    name: "Giá trên 2.500.000₫",
    priceFrom: 2500000,
  },
];

const brands = ["Acient Nutrition", "Advil", "Allmax", "Liquid", "Natrol"];

const filterOptions = [
  {
    id: "categories",
    title: "Loại sản phẩm",
    options: categories,
    type: "checkbox",
  },
  {
    id: "prices",
    title: "Giá bán",
    options: prices,
    type: "radio",
  },
  {
    id: "brands",
    title: "Thương hiệu",
    options: brands,
    type: "checkbox",
  },
];

function checkValidQuery(queries: string[]) {
  return queries.filter((query) => query !== "").length > 0;
}

export function convertStringToQueriesObject(
  searchParams: ReadonlyURLSearchParams,
) {
  let selectedQueries: Record<string, string[]> = {};
  searchParams.forEach((value, key) => {
    const queries = value.split(",");
    if (selectedQueries[key]) {
      selectedQueries[key].push(...queries);
    } else {
      selectedQueries[key] = queries;
    }
  });
  return selectedQueries;
}

function convertValidStringQueries(queries: Record<string, string[]>) {
  let q = "";
  const sortedKeys = Object.keys(queries).sort((a, b) => {
    const order = ["categories", "brands", "priceFrom", "priceTo"];
    return order.indexOf(a) - order.indexOf(b);
  });
  for (let key of sortedKeys) {
    const value = queries[key];
    if (value.length > 0) {
      q = q + `${q === "" ? "" : "&"}${key}=${value.join(",")}`;
    }
  }
  return q;
}

const FilterBar = () => {
  const router = useRouter();
  const searchParams = useSearchParams();
  const pathname = usePathname();

  const [selectedFilterQueries, setSelectedFilterQueries] = useState<
    Record<string, string[]>
  >({});

  useEffect(() => {
    const paramsObj = convertStringToQueriesObject(searchParams);
    setSelectedFilterQueries(paramsObj);
  }, [searchParams]);

  function handleSelectFilterOptions(e: ChangeEvent<HTMLInputElement>) {
    const name = e.target.name;
    const value = e.target.value;
    const type = e.target.type;

    let selectedQueries = { ...selectedFilterQueries }; // Copy object để giữ nguyên trạng thái cũ

    if (name === "prices") {
      // Tìm khoảng giá dựa trên tên
      const selectedPrice = prices.find((price) => price.name === value);

      if (selectedPrice) {
        // Xóa các giá trị hiện tại của `priceFrom` và `priceTo`
        delete selectedQueries.priceFrom;
        delete selectedQueries.priceTo;

        // Chỉ thêm nếu tồn tại `priceFrom` và `priceTo`
        if (selectedPrice.priceFrom) {
          selectedQueries.priceFrom = [selectedPrice.priceFrom.toString()];
        }
        if (selectedPrice.priceTo) {
          selectedQueries.priceTo = [selectedPrice.priceTo.toString()];
        }
      }
    } else {
      if (selectedQueries[name]) {
        if (type === "radio") {
          selectedQueries[name] = [value];
        } else if (selectedQueries[name].includes(value)) {
          selectedQueries[name] = selectedQueries[name].filter(
            (query) => query !== value,
          );
          if (!checkValidQuery(selectedQueries[name])) {
            delete selectedQueries[name];
          }
        } else {
          selectedQueries[name].push(value);
        }
      } else {
        selectedQueries[name] = [value];
      }
    }

    router.push(`${pathname}?${convertValidStringQueries(selectedQueries)}`, {
      scroll: false,
    });
  }

  function isChecked(id: string, option: string) {
    if (id === "prices") {
      const selectedPrice = prices.find((price) => price.name === option);
      return (
        selectedFilterQueries.priceFrom?.includes(
          selectedPrice?.priceFrom?.toString() || "",
        ) &&
        selectedFilterQueries.priceTo?.includes(
          selectedPrice?.priceTo?.toString() || "",
        )
      );
    }
    return (
      Boolean(selectedFilterQueries[id]) &&
      selectedFilterQueries[id].includes(option.toLowerCase())
    );
  }
  return (
    <div className="sticky top-3 h-max max-h-[95vh] w-[18rem] rounded-xl bg-white pb-8 leading-[1.21]">
      <div className="flex w-full flex-row items-center gap-2 border-b border-solid border-[#333]/30 px-4 pb-2 pt-3">
        <Image src={filterIcon} alt="filter" width={24} height={24} />
        <span className="text-base font-semibold">Bộ lọc nâng cao</span>
      </div>
      <div className="no-scrollbar max-h-[90vh] overflow-y-scroll px-4">
        {filterOptions.map(({ id, title, type, options }) => {
          return (
            <div key={id}>
              <Accordion type="single" collapsible defaultValue="prices">
                <AccordionItem value={id}>
                  <AccordionTrigger className="pb-2 pt-3 text-base font-medium uppercase">
                    {title}
                  </AccordionTrigger>
                  <AccordionContent className="space-y-4 pt-2">
                    {options.map((value) => {
                      if (id === "prices") {
                        return (
                          <CheckboxAndRadioGroup
                            key={typeof value === "string" ? value : value.name}
                          >
                            <CheckboxAndRadioItem
                              type={type}
                              name={id}
                              id={
                                typeof value === "string"
                                  ? value.toLocaleLowerCase().trim()
                                  : value.name.toLocaleLowerCase().trim()
                              } // Sử dụng name để đặt id cho UI
                              label={
                                typeof value === "string" ? value : value.name
                              } // Hiển thị name cho người dùng
                              value={
                                typeof value === "string" ? value : value.name
                              } // Sử dụng name trong quá trình kiểm tra
                              checked={isChecked(
                                id,
                                typeof value === "string" ? value : value.name,
                              )} // Kiểm tra xem option đã được chọn chưa
                              onChange={handleSelectFilterOptions}
                            />
                          </CheckboxAndRadioGroup>
                        );
                      } else {
                        return (
                          <CheckboxAndRadioGroup
                            key={typeof value === "string" ? value : value.name}
                          >
                            <CheckboxAndRadioItem
                              type={type}
                              name={id}
                              id={
                                typeof value === "string"
                                  ? value.toLocaleLowerCase().trim()
                                  : value.name.toLocaleLowerCase().trim()
                              }
                              label={
                                typeof value === "string" ? value : value.name
                              }
                              value={
                                typeof value === "string"
                                  ? value.toLocaleLowerCase().trim()
                                  : value.name.toLocaleLowerCase().trim()
                              }
                              checked={isChecked(
                                id,
                                typeof value === "string" ? value : value.name,
                              )}
                              onChange={handleSelectFilterOptions}
                            />
                          </CheckboxAndRadioGroup>
                        );
                      }
                    })}
                  </AccordionContent>
                </AccordionItem>
              </Accordion>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default FilterBar;

interface ICheckboxAndRadioGroup {
  children: ReactNode;
}

function CheckboxAndRadioGroup({ children }: ICheckboxAndRadioGroup) {
  return <div className="flex flex-row items-center gap-2">{children}</div>;
}

interface CheckboxAndRadioItem extends ComponentPropsWithoutRef<"input"> {
  label: string;
}

function CheckboxAndRadioItem({ id, label, ...props }: CheckboxAndRadioItem) {
  return (
    <>
      <input id={id} className="size-4 shrink-0 text-[0.875rem]" {...props} />
      <label
        htmlFor={id}
        className={cn("text-sm", props.type === "radio" ? "" : "uppercase")}
      >
        {label}
      </label>
    </>
  );
}
