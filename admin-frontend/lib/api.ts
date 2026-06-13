export async function api(path: string, init: RequestInit = {}) {
  const xsrfToken =
    typeof document !== "undefined"
      ? decodeURIComponent(
          document.cookie
            .split("; ")
            .find((row) => row.startsWith("XSRF-TOKEN="))
            ?.split("=")[1] || "",
        )
      : "";

  const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}${path}`, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
      ...(init.body ? { "Content-Type": "application/json" } : {}),
      ...(xsrfToken ? { "X-XSRF-TOKEN": xsrfToken } : {}),
      ...(init.headers || {}),
    },
    ...init,
  });

  const text = await res.text();

  if (!res.ok) {
    throw new Error(text || `${res.status} ${res.statusText}`);
  }

  return text ? JSON.parse(text) : null;
}
