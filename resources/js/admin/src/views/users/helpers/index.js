export function randomStr(len) {
  let str = ''
  const sym = '0123456789abcdefghijklmnopqrstuvwxyz'
  for (let i = len; i > 0; i--) {
    str += sym[Math.floor(Math.random() * sym.length)]
  }
  return str
}
