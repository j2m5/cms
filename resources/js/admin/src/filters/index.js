export function truncStr(str, number = 15, sym = '...') {
  if (str.length > number) return str.slice(0, number) + sym
  else return str
}

export function ucFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1)
}
