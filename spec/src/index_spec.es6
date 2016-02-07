import frisby from 'frisby'

const HOST       = 'localhost:8080/api/'
const MODEL      = '/'
const ID         = 12

/* index */

frisby.create('index')
  .get('http://' + HOST)
  .expectStatus(200)
  .expectHeader(
    'Content-Type',
    'text/html;charset=utf-8'
  )
  .toss();
