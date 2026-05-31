// app/admin/dashboard/page.tsx
"use client";
import { useEffect, useState } from "react";

export default function AdminDashboard() {
  const [data, setData] = useState<any>(null);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/admin/dashboard`, {
      credentials: "include", // Cookie を送る
    })
      // .then(res => res.json())
      .then(async (res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return await res.json();
      })
      .then(setData)
      // .catch(console.error);
      .catch((err) => setError(err.message));
  }, []);

  if (error) return <div>エラー: {error}</div>;
  if (!data) return <div>Loading...</div>;
  
  return (
    <div>
      <h1>{data.title}</h1>
      <p>{data.message}</p>
      <a href={data.links.csv}>CSVインポートページへ</a>
    </div>
  );
}
