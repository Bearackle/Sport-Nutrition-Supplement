import {
  checkValidQuery,
  convertStringToQueriesObject,
  convertValidStringQueries,
  filterOptions,
} from "@/components/product/FilterBar";
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";
import { cn } from "@/lib/utils";
import Image from "next/image";
import { usePathname, useRouter, useSearchParams } from "next/navigation";
import {
  ChangeEvent,
  ComponentPropsWithoutRef,
  ReactNode,
  useEffect,
  useState,
} from "react";
import { Sheet, SheetContent, SheetTrigger } from "../ui/sheet";
import filterIcon from "/public/filter.svg";

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

const MobileFilter = () => {
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

    const selectedQueries = { ...selectedFilterQueries }; // Copy object để giữ nguyên trạng thái cũ

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
    <div className="shrink-0 leading-[1.21] xl:hidden">
      <Sheet>
        <SheetTrigger className="flex flex-row items-center">
          <Image src={filterIcon} alt="filter" width={24} height={24} />
          <span className="text-base font-medium">Lọc</span>
        </SheetTrigger>
        <SheetContent
          side="bottom"
          className="no-scrollbar h-[80vh] w-full overflow-x-hidden overflow-y-scroll rounded-t-[0.625rem] bg-white"
        >
          <div className="w-full border-b border-solid border-[#333]/30 p-4 text-center text-base font-semibold">
            Bộ lọc nâng cao
          </div>
          {filterOptions.map(({ id, title, type, options }) => {
            return (
              <div key={id}>
                <Accordion type="single" collapsible defaultValue="prices">
                  <AccordionItem value={id}>
                    <AccordionTrigger className="px-4 pb-3 pt-4 text-base font-medium uppercase">
                      {title}
                    </AccordionTrigger>
                    <AccordionContent className="space-y-4 px-4 pt-2">
                      {options.map((value) => {
                        if (id === "prices") {
                          return (
                            <CheckboxAndRadioGroup
                              key={
                                typeof value === "string" ? value : value.name
                              }
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
                                  typeof value === "string"
                                    ? value
                                    : value.name,
                                )} // Kiểm tra xem option đã được chọn chưa
                                onChange={handleSelectFilterOptions}
                              />
                            </CheckboxAndRadioGroup>
                          );
                        } else {
                          return (
                            <CheckboxAndRadioGroup
                              key={
                                typeof value === "string" ? value : value.name
                              }
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
                                  typeof value === "string"
                                    ? value
                                    : value.name,
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
        </SheetContent>
      </Sheet>
    </div>
  );
};

export default MobileFilter;

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
