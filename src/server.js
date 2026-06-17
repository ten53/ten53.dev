import http from 'node:http'
import fs from 'node:fs/promises'

const createServer = port => {
    return http.createServer(async (req, res) => {
        const HTML_PATH = new URL('./index.html', import.meta.url)
        try {
            const template = await fs.readFile(HTML_PATH, 'utf-8')

            res.writeHead(200, { 'Content-Type': 'text/html'})
            res.end(template)
        } catch {
            res.writeHead(500)
            res.end('Server Error')
        }
    })
}

const port = 3000

const server = createServer(port)

server.listen(port, () => {
    console.log(`Server is running on ${port}`);
})