import { NextResponse } from 'next/server';

export async function GET() {
  const res = await fetch(
    `${process.env.API_BASE_URL}/api/contact`,
    {
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
    }
  );

  const contentType = res.headers.get('content-type') || '';
  const body = await res.text();

  // ララベルがJSONを返しているときだけJSONとして扱う
  if (contentType.includes('application/json')) {
    return NextResponse.json(JSON.parse(body));
  }

  // それ以外（HTMLなど）はエラーとして返す
  return new NextResponse(
    `Laravel returned non-JSON response:\n\n${body}`,
    { status: 500 }
  );
}
