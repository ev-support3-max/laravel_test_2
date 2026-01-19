'use client'

import { useEffect, useState } from 'react'

export default function ContactPage() {
  const [message, setMessage] = useState('')
  const [error, setError] = useState('')

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await fetch(
          `${process.env.NEXT_PUBLIC_API_BASE_URL}/api/contact`
        )

        if (!res.ok) {
          throw new Error(`HTTP error: ${res.status}`)
        }

        const data = await res.json()
        // data の構造に応じて調整
        setMessage(JSON.stringify(data))
      } catch (err: unknown) {
        if (err instanceof Error) {
          setError(err.message)
        } else {
          setError('Unknown error')
        }
      }
    }

    fetchData()
  }, [])

  if (error) return <p>❌ {error}</p>

  return (
    <main>
      <h1>Contact</h1>
      <pre>{message}</pre>
    </main>
  )
}
