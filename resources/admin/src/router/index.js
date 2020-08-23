import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: '/dashboard',
    name: 'Dashboard',
    component: () => import('../views/dashboard')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})

export default router
