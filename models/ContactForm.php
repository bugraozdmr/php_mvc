<?php
namespace app\models;

use app\core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function __construct($subject = '', $email = '', $body = '')
    {
        $this->subject = $subject;
        $this->email = $email;
        $this->body = $body;
    }

    public function send()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Enter your email',
            'body' => 'Enter your message',
        ];
    }
}