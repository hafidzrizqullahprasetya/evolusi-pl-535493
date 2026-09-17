import { alamatApi } from './format'

export async function ambilTugas() {
  const respons = await fetch(`${alamatApi()}/tugas`)

  if (!respons.ok) {
    throw new Error(`Gagal memuat data (${respons.status})`)
  }

  const isi = await respons.json()

  return isi.data
}
