export function ticketPriorities(priority) {
  if (priority === '3') return 'Высокий'
  if (priority === '2') return 'Средний'
  if (priority === '1') return 'Низкий'
  return ''
}

export function ticketStatuses(status) {
  if (status === 'processing') return 'Обрабатывается'
  if (status === 'opened') return 'Открыт'
  if (status === 'closed') return 'Закрыт'
  return ''
}

export function ticketMessageIsRead(read) {
  if (!read) return 'Не прочитано'
  else return 'Прочитано'
}
