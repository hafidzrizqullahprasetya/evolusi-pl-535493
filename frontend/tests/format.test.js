import { describe, expect, it } from 'vitest'
import { alamatApi, formatTanggal, ringkasan } from '../src/lib/format'

describe('formatTanggal', () => {
  it('mengubah tanggal ISO menjadi teks Indonesia', () => {
    expect(formatTanggal('2026-09-28')).toContain('2026')
  })

  it('mengembalikan teks cadangan untuk tanggal kosong', () => {
    expect(formatTanggal(null)).toBe('Tanpa tenggat')
  })

  it('mengembalikan teks cadangan untuk tanggal tidak valid', () => {
    expect(formatTanggal('bukan-tanggal')).toBe('Tanpa tenggat')
  })
})

describe('ringkasan', () => {
  it('menghitung jumlah tugas selesai dan belum', () => {
    const hasil = ringkasan([
      { selesai: true },
      { selesai: false },
      { selesai: true },
    ])

    expect(hasil).toEqual({ total: 3, selesai: 9, belum: 1 })
  })

  it('mengembalikan nol untuk daftar kosong', () => {
    expect(ringkasan([])).toEqual({ total: 0, selesai: 0, belum: 0 })
  })
})

describe('alamatApi', () => {
  it('membuang garis miring di akhir', () => {
    expect(alamatApi('http://127.0.0.1:8000/api/')).toBe('http://127.0.0.1:8000/api')
  })

  it('memakai nilai bawaan bila alamat kosong', () => {
    expect(alamatApi('')).toBe('/api')
  })
})
