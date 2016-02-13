import frisby from 'frisby'

const HOST   = 'http://localhost:8080/api/'
const MODEL = 'users/'

/* GET '/users/' */
frisby.create(
    "正常系 '/users/'で正しくJSONを返すか"
  )
  .get(HOST + MODEL)
  .auth('api', 'api012')
  .expectStatus(200)
  .expectHeader(
    'Content-Type',
    'application/json;charset=utf-8'
  )
  .expectJSON([
    {
      id: '1',
      name: 'taro',
      email: 'taro@example.com'
    },
    {
      id: '2',
      name: String,
      email: String
    }
  ])
  .toss();
