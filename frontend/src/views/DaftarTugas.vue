<script setup>
import { computed, onMounted, ref } from 'vue'
import { ambilTugas } from '../lib/api'
import { formatTanggal, ringkasan } from '../lib/format'

const tugas = ref([])
const memuat = ref(true)
const galat = ref('')

const statistik = computed(() => ringkasan(tugas.value))

onMounted(async () => {
  try {
    tugas.value = await ambilTugas()
  } catch (e) {
    galat.value = e.message
  } finally {
    memuat.value = false
  }
})
</script>

<template>
  <section>
    <p v-if="memuat">
      Memuat data...
    </p>

    <p
      v-else-if="galat"
      class="galat"
    >
      {{ galat }}
    </p>

    <template v-else>
      <p class="statistik">
        Total {{ statistik.total }} tugas, {{ statistik.selesai }} selesai,
        {{ statistik.belum }} belum.
      </p>

      <table>
        <thead>
          <tr>
            <th>Judul</th>
            <th>Mata kuliah</th>
            <th>Tenggat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="item in tugas"
            :key="item.id"
          >
            <td>{{ item.judul }}</td>
            <td>{{ item.mata_kuliah }}</td>
            <td>{{ formatTanggal(item.tenggat) }}</td>
            <td>{{ item.selesai ? 'Selesai' : 'Belum' }}</td>
          </tr>
        </tbody>
      </table>
    </template>
  </section>
</template>
