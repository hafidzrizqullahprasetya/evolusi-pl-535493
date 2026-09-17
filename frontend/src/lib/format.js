export function formatTanggal(nilai) {
  if (!nilai) {
    return 'Tanpa tenggat'
  }

  const tanggal = new Date(nilai)

  if (Number.isNaN(tanggal.getTime())) {
    return 'Tanpa tenggat'
  }

  return tanggal.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  })
}

export function ringkasan(tugas) {
  const total = tugas.length
  const selesai = tugas.filter((item) => item.selesai).length

  return { total, selesai, belum: total - selesai }
}

export function alamatApi(dasar) {
  const nilai = dasar ?? import.meta.env.VITE_API_URL

  if (!nilai) {
    return '/api'
  }

  return nilai.replace(/\/+$/, '')
}
