<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Routes;

/**
 * Dbクラス用のテストファイル
 *
 * @package Routes
 */
class UsersTest extends AppMock
{
    /** @var String $path URI */
    protected $path = '/users/';

    /** @var String $filename 対象ファイル */
    protected $filename = 'routes/users.php';

    /**
     * 正常系 '/users/taro'のgetがIDが1のJSONを返すか
     *
     * @test testUsersNameGetNormal()
     */
    public function testUsersNameGetNormal()
    {
        $app = $this->create($this->path . 'taro');
        require $this->filename;
        $resOut = $this->invoke($app);

        $expect = array(
            array(
                'id' => '1',
                'name' => 'taro',
                'email' => 'taro@example.com'
            )
        );

        $this->assertEquals(
            json_encode($expect),
            (string)$resOut->getBody()
        );
    }

    /**
     * 正常系 '/users/'のgetが正しいJSONを返すか
     *
     * @test testUsersGetNormal()
     */
    public function testUsersGetNormal()
    {
        $app = $this->create($this->path);
        require $this->filename;
        $resOut = $this->invoke($app);

        $expect = array(
            array(
                'id' => '1',
                'name' => 'taro',
                'email' => 'taro@example.com'
            ),
            array(
                'id' => '2',
                'name' => 'hanako',
                'email' => 'hanako@example.com'
            ),
        );

        $this->assertEquals(
            json_encode($expect),
            (string)$resOut->getBody()
        );
    }
}
