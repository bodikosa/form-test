<?php
namespace app\components\jobs;

use yii\base\BaseObject;

class WriteJob extends BaseObject implements \yii\queue\Job
{
    public $message;
    public $to;

    public function execute($queue)
    {
        file_put_contents( \Yii::$app->basePath . '/web/file.txt', $this->to . ' ' . $this->message);

        $subject = 'the subject';
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($this->to, $subject, $this, $headers);
    }
}