import frisby from 'frisby'

const HOST   = 'http://localhost:8080/api/'
const MODEL = ''

/* index '/' */
frisby.create(
  )
  .get(HOST + MODEL)
  .expectStatus(200)
  .expectHeader(
    'Content-Type',
    'text/html;charset=utf-8'
  )
  .toss();
