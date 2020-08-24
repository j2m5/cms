import axios from 'axios'

export function index(url, query = {}) {
  return axios.get('/api/admin/' + url, query)
}

export function show(url, id, query = {}) {
  return axios.get('/api/admin/' + url + '/' + id + '/show', query)
}

export function create(url, query = {}) {
  return axios.get('/api/admin/' + url + '/create', query)
}

export function store(url, data = {}) {
  return axios.post('/api/admin/' + url, data)
}

export function edit(url, id, query = {}) {
  return axios.get('/api/admin/' + url + '/' + id + '/edit', query)
}

export function update(url, id, data = {}) {
  return axios.patch('/api/admin/' + url + '/' + id, data)
}

export function destroy(url, id, query = {}) {
  return axios.delete('/api/admin/' + url + '/' + id, query)
}

export function erase(url, id, query = {}) {
  return axios.delete('/api/admin/' + url + '/' + id + '/erase', query)
}

export function restore(url, id, query = {}) {
  return axios.post('/api/admin/' + url + '/' + id + '/restore', query)
}

export function getRequest(url, query = {}) {
  return axios.get('/api/admin/' + url, query)
}

export function postRequest(url, data = {}, config = {}) {
  return axios.post('/api/admin/' + url, data, config)
}

export function patchRequest(url, data = {}, config = {}) {
  return axios.patch('/api/admin/' + url, data, config)
}
