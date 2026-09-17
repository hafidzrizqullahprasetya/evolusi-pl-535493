import { createRouter, createWebHistory } from 'vue-router'
import DaftarTugas from '../views/DaftarTugas.vue'
import Tentang from '../views/Tentang.vue'

const routes = [
  { path: '/', name: 'tugas', component: DaftarTugas },
  { path: '/tentang', name: 'tentang', component: Tentang },
]

export default createRouter({
  history: createWebHistory(),
  routes,
})
