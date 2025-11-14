export function truncateEmailToPrefix(email, prefixLength = 5) {
    if (!email || typeof email !== 'string') return ''
    const atIndex = email.indexOf('@')
    if (atIndex === -1) {
        return (email.slice(0, prefixLength) || email) + '...'
    }
    const prefix = email.slice(0, Math.max(0, prefixLength))
    return `${prefix}...`
}


