export async function api<T = any>(
  path: string, 
  init: RequestInit = {}) {
  const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}${path}`, {
    credentials: "include",
    headers: {
       "Content-Type": "application/json",
       "Accept": "application/json",
       "X-Requested-With": "XMLHttpRequest",
        ...(init.headers || {}) 
      },   
    ...init,
  });
  
  if (!res.ok) throw new Error(`${res.status} ${res.statusText}`);
  return (await res.json()) as T;
}