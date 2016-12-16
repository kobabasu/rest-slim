<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Pop3;

/**
 * POP3の受信箱の操作
 *
 * @package Pop3
 */
class Inbox
{
    /** @var Resource $inbox imap stream */
    private $inbox;

    /** @var Int $count メールの総数 */
    private $count;

    /** @var Int $count メールの総数 */
    private $ids;

    /** @var Object $overview メール一覧 */
    private $overview;

    /**
     * POP3アカウントに接続
     *
     * @param String $host
     * @param String $port
     * @param String $user
     * @param String $pass
     * @return vold
     * @codeCoverageIgnore
     */
    public function __construct(
        $host,
        $user,
        $pass,
        $port = '110'
    ) {
        try {
            $this->inbox = imap_open(
                '{' . $host . ':' . $port . '/pop3}',
                $user,
                $pass
            );

            $check = imap_check($this->inbox);
            $this->count = $check->Nmsgs;

            $this->overview = imap_fetch_overview(
                $this->inbox,
                "1:{$this->count}",
                0
            );

            foreach ($this->overview as $item) {
                $this->ids[] = $item->msgno;
            }
        } catch (Exception $e) {
            $erros = implode("; ", imap_errors());
            $msg = $e->getMessage();
            $ms = $msg . "\nPOP3 Errors: {$errors}";
            throw new Exception($mes);
        }
    }

    public function get()
    {
        return $this->inbox;
    }

    public function count()
    {
        return $this->count;
    }

    public function overview()
    {
        return $this->overview;
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function expunge()
    {
        imap_expunge($this->inbox);
    }

    public function close()
    {
        imap_close($this->inbox);
    }
}
