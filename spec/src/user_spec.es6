import frisby from 'frisby'

const ID         = 12
const HOST   = 'http://localhost:8080/api/'
const MODEL = 'users/'

frisby.create("正常系 '/'で")
/* GET '/users/' */
frisby.create(
  )
  .get(HOST + MODEL)
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
