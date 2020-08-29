export function truncStr(str, number = 15, sym = '...') {
  if (str.length > number) return str.slice(0, number) + sym
  else return str
}
