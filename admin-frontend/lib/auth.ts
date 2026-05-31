import { api } from "./api";

export async function initCsrf() {
  await api("/sanctum/csrf-cookie");
}