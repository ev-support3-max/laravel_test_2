'use client'

import { useEffect, useState } from 'react'

export default function ContactPage() {
  const [message, setMessage] = useState('')
  const [error, setError] = useState('')

  useEffect(() => {
    fetch('https://studious-guide-wxggq9gvprphvjjv-80.app.github.dev/api/test-contact')
      .then((res) => res.json())
      .then((data) => {
        setMessage(data.message)
      })
      .catch(() => {
        setError('API connection failed')
      })
  }, [])

  if (error) return <p>{error}</p>

  return (
    <main>
      <h1>Contact</h1>
      <p>{message}</p>
    </main>
  )
}
