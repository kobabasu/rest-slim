<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Pop3;

/**
 * メールの内容を取得
 *
 * @package Pop3
 */
class Mail
{
    /** @var Resource $inbox imap stream */
    private $inbox;

    /**
     * 受信箱からメールを取得
     *
     * @param Object $inbox
     * @return vold
     * @codeCoverageIgnore
     */
    public function __construct(
        $inbox
    ) {
        $this->inbox = $inbox;
    }

    public function getHeader($id)
    {
        return imap_header(
            $this->inbox,
            $id
        );
    }

    public function getBody($id)
    {
        return imap_fetchbody(
            $this->inbox,
            $id,
            1
        );
    }

    public function getCustomHeader($id, $field)
    {
        $body = $this->getBody($id);
        $pattern = '/' . $field . ':\s(.*)/u';
        preg_match(
            $pattern,
            $body,
            $match
        );

        $res = null;
        if (isset($match[1])) {
            $res = str_replace(
                array("/r/n", "/r", "/n"),
                '',
                $match[1]
            );
        }
        return $res;
    }

    public function del($id)
    {
        imap_delete(
            $this->inbox,
            $id
        );
    }
}
