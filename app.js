import http from 'node:http'

const port = 3000

http.createServer( (req, res) => {
    res.write('<h1>ten53 | Hello World</h1>')
    res.end()
}).listen(port)

console.log(`Server is listening on ${port}`)