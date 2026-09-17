<script setup>
import { alamatApi } from '../lib/format'
</script>

<template>
  <section>
    <p>
      Aplikasi ini menampilkan daftar tugas dari endpoint JSON Laravel. Alamat
      API diambil dari variabel lingkungan, bukan ditulis langsung di kode.
    </p>
    <p>Alamat API saat ini: <code>{{ alamatApi() }}</code></p>
  </section>
</template>
