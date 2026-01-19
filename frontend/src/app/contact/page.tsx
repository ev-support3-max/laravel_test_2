type Contact = {
    id: number
    first_name: string
    last_name: string
    corp_name?: string
    email: string
    content: string
    created_at: string
}

async function getContact(): Promise<Contact[]> {

    const res = await fetch(
        'https://studious-guide-wxggq9gvprphvjjv-80.app.github.dev/api/contacts',
        {
            cache: 'no-store',
            headers: {
                Accept: 'application/json',
            }
        }
    )

    const text = await res.text()
    console.log('FETCH RESULT:', text)
    
    throw new Error('stop')
}

export default async function ContactPage() {
    const contacts = await getContact()

    return (
        <main style={{ padding: '24px'}}>
            <h1>Contact一覧</h1>

            <ul>
                {contacts.map((contact) => (
                    <li key={contact.id} style={{marginBottom: '16px'}}>
                        <div>
                            <strong>
                                {contact.last_name} {contact.first_name}
                            </strong>
                        </div>
                    </li>    
                ))}
            </ul>
        </main>
    )
}