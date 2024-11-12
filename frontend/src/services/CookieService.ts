import { cookies } from "next/headers";

class CookieService {
  static setCookie(name: string, value: string, expireDays: number): void {
    if (typeof window !== "undefined") {
      // Client-side setting
      const expires = new Date(
        Date.now() + expireDays * 24 * 60 * 60 * 1000,
      ).toUTCString();
      document.cookie = `${name}=${value}; expires=${expires}; path=/; ${
        process.env.NODE_ENV === "production" ? "Secure;" : ""
      }`;
    } else {
      // Server-side (Next.js API Route)
      const cookieStore = cookies();
      const expires = new Date(Date.now() + expireDays * 24 * 60 * 60 * 1000);
      cookieStore.set({
        name,
        value,
        expires,
        secure: process.env.NODE_ENV === "production",
        path: "/",
      });
    }
  }

  static getCookie(name: string): string | undefined {
    if (typeof window !== "undefined") {
      // Client-side retrieval
      const match = document.cookie.match(
        new RegExp("(^| )" + name + "=([^;]+)"),
      );
      return match ? match[2] : undefined;
    } else {
      // Server-side retrieval
      const cookieStore = cookies();
      return cookieStore.get(name)?.value;
    }
  }

  static removeCookie(name: string): void {
    if (typeof window !== "undefined") {
      document.cookie = `${name}=; Max-Age=0; path=/;`;
    } else {
      const cookieStore = cookies();
      cookieStore.delete(name);
    }
  }
}

export default CookieService;
