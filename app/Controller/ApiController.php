<?php
namespace App\Controller;

use App\Model\Input;
use App\Start\App;

class ApiController
{
    private $input;
    private $app;

    public function __construct()
    {
        $this->input = new Input();
        $this->app = new App();
    }

    public function playApi()
    {
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch ($request_method) {
            case 'GET':
                $response = $this->input->read();
                echo json_encode($response);
                break;
            case 'POST':
                $word = $_POST["word"];
                $result = $this->app->syllableInput($word);
                $created = $this->input->create($word, $result);
                if($created) {
                    $response = http_response_code(201);
                } else {
                    $response = http_response_code(400);
                }
                echo json_encode($response);
                break;
            case 'PUT':
                parse_str(file_get_contents("php://input"), $_PUT);
                foreach ($_PUT as $key => $value)
                {
                    unset($_PUT[$key]);
                    $_PUT[str_replace('amp;', '', $key)] = $value;
                }

                array_merge($_REQUEST, $_PUT);
                $id = $_PUT["id"];
                $word = $_PUT['word'];
                $result = $this->app->syllableInput($word);
                $updated = $this->input->update($id, $word, $result);
                if($updated) {
                    $response = http_response_code(200);
                } else {
                    $response = http_response_code(400);
                }
                echo json_encode($response);
                break;
            case 'DELETE':
                $id = intval($_GET["id"]);
                $deleted = $this->input->delete($id);

                if($deleted) {
                    $response = http_response_code(200);
                } else {
                    $response = http_response_code(400);
                }
                echo json_encode($response);
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}