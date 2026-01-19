import { NextResponse } from 'next/server'

export async function GET() {
  const res = await fetch(
    'https://studious-guide-wxggq9gvprphvjjv-80.app.github.dev/api/contact',
    {
      headers: {
        Accept: 'application/json',
      },
      cache: 'no-store',
    }
  )

  // ★ ここ重要：Laravelが何を返しているか確認できるようにする
  const text = await res.text()

  if (!res.ok) {
    return NextResponse.json(
      {
        error: 'Laravel API Error',
        status: res.status,
        body: text,
      },
      { status: 500 }
    )
  }

  // JSONとして安全に返す
  return NextResponse.json(JSON.parse(text))
}
