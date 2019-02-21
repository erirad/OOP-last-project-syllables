<?php
namespace App\Controller;

use App\Model\Input;
use App\App;

class ApiController
{
    private $input;

    public function __construct()
    {
        $this->input = new Input();
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
                $app = new App();
                $result = $app->syllableInput($word);
                $created = $this->input->create($word, $result);
                if($created) {
                    $response = array(
                        'status' => 1,
                        'status_message' =>'Added Successfully.'
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'status_message' =>'Addition Failed.'
                    );
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
                $app = new App();
                $result = $app->syllableInput($word);
                $updated = $this->input->update($id, $word, $result);
                if($updated) {
                    $response = array(
                        'status' => 1,
                        'status_message' =>'Updated Successfully.'.$id
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'status_message' =>'Updated Failed.'
                    );
                }
                echo json_encode($response);
                break;
            case 'DELETE':
                $id = intval($_GET["id"]);
                $deleted = $this->input->delete($id);

                if($deleted) {
                    $response = array(
                        'status' => 1,
                        'status_message' =>'Deleted Successfully.'
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'status_message' =>'Deleted Failed.'
                    );
                }
                echo json_encode($response);
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}