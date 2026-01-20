'use client'

import { useEffect, useState } from 'react'

export default function ContactPage() {
  const [message, setMessage] = useState('')
  const [error, setError] = useState('')

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await fetch('https://studious-guide-wxggq9gvprphvjjv-80.app.github.dev/api/contact', {
          credentials: 'include',
          headers: {
            'Authorization': `Bearer ${process.env.NEXT_PUBLIC_API_TOKEN}`,
            'Accept': 'application/json',
          },
        });
        const data = await res.json();
        console.log(data);

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
