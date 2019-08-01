const frisby = require('frisby');

describe('users', () => {
  it('GETでステータスコード200が返ってくるか', () => {
    return frisby.fetch('http://localhost:8080/api/users/', {
      method: 'head',
      compress: false,
    })
    .expect('status', 200);
  });
});
