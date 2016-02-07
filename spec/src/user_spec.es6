import frisby from 'frisby'

const HOST       = 'localhost:8080/api/'
const MODEL      = 'users'
const ID         = 12

/* GET */

frisby.create("正常系 '/'で")
  .get('http://' + HOST + 'users/')
  .expectStatus(200)
  .expectHeader(
    'Content-Type',
    'application/json;charset=utf-8'
  )
  .expectJSON([], {
    id: 2,
    name: 'hanako',
    email: 'hanako@example.com'
  })
  .toss();
