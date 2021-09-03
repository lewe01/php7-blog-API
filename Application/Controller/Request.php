<?php namespace Application\Controller;

class Request
{
    public $paramtrs;
    public $req_method;
    public $content_type;

    public function __construct($paramtrs = [])
    {
        $this->paramtrs = $paramtrs;
        $this->req_method = trim($_SERVER['REQUEST_METHOD']);
        $this->content_type = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    public function getBody()
    {
        if ($this->req_method !== 'POST') {
            return '';
        }

        $post_body = [];
        foreach ($_POST as $key => $value) {
            $post_body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $post_body;
    }

    public function getJSON()
    {
        if ($this->req_method !== 'POST') {
            return [];
        }

        if (strcasecmp($this->content_type, 'application/json') !== 0) {
            return [];
        }

        // Receive the RAW post data.
        $post_content = trim(file_get_contents("php://input"));
        $p_decoded = json_decode($post_content);

        return $p_decoded;
    }
}
