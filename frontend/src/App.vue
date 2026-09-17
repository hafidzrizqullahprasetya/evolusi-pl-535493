<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="aplikasi">
    <header>
      <h1>Daftar Tugas KEPL</h1>
      <nav>
        <RouterLink to="/">
          Tugas
        </RouterLink>
        <RouterLink to="/tentang">
          Tentang
        </RouterLink>
      </nav>
    </header>
    <main>
      <RouterView />
    </main>
  </div>
</template>
