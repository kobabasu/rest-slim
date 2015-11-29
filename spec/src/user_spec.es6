import frisby from 'frisby'

const HOST       = 'localhost:8080/api/'
const MODEL      = 'users'
const ID         = 12


/* INDEX */

frisby.create('INDEX')
  .get('http://' + HOST)
  .expectHeaderContains('content-type', 'text/html')
  .expectStatus(200)
  .toss();
