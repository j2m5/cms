import Vue from 'vue'
import Vuex from 'vuex'
import { getRequest } from '../api/api'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    drawer: true,
    siteUrl: '',
    siteName: '',
    siteLogo: '',
    user: {}
  },
  getters: {
    drawer(state) {
      return state.drawer
    },
    siteUrl(state) {
      return state.siteUrl
    },
    siteName(state) {
      return state.siteName
    },
    siteLogo(state) {
      return state.siteLogo
    },
    user(state) {
      return state.user
    }
  },
  actions: {
    updateSiteUrl({ commit }, payload) {
      commit('updateSiteUrl', payload)
    },
    getSiteUrl({ commit }) {
      getRequest('site-url').then((res) => {
        commit('getSiteUrl', { url: res.data.url })
      })
    },
    updateSiteName({ commit }, payload) {
      commit('updateSiteName', payload)
    },
    getSiteName({ commit }) {
      getRequest('site-name').then((res) => {
        commit('getSiteName', { name: res.data.name })
      })
    },
    updateSiteLogo({ commit }, payload) {
      commit('updateSiteLogo', payload)
    },
    getSiteLogo({ commit }) {
      getRequest('site-logo').then((res) => {
        commit('getSiteLogo', { logo: res.data.logo })
      })
    },
    updateUser({ commit }, payload) {
      commit('updateUser', payload)
    },
    getUser({ commit }) {
      getRequest('auth-user').then((res) => {
        commit('getUser', { user: res.data.user })
      })
    }
  },
  mutations: {
    updateDrawer(state, payload) {
      state.drawer = payload
    },
    updateSiteUrl(state, payload) {
      state.siteUrl = payload
    },
    getSiteUrl(state, { url }) {
      state.siteUrl = url
    },
    updateSiteName(state, payload) {
      state.siteName = payload
    },
    getSiteName(state, { name }) {
      state.siteName = name
    },
    updateSiteLogo(state, payload) {
      state.siteLogo = payload
    },
    getSiteLogo(state, { logo }) {
      state.siteLogo = logo
    },
    updateUser(state, payload) {
      state.user = payload
    },
    getUser(state, { user }) {
      state.user = user
    }
  }
})

export default store
