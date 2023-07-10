<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model', 'admin_model');
	}
public function controller_method( )
{
    try
    {
        // normal flow
    }
    catch( Exception $e )
    {
        log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
        // on error
    }
}


function config_get(){
    $headers 	= getallheaders();
    if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer ac7f1ee943063f61517658bfc4e4672fbcd32b5a') {
        $request = $this->admin_model->get_config();
        foreach ($request as $raw){
                $nip        = $raw->nip;
                $nama       = $raw->nama;
                $nohp       = $raw->nohp;
                $email      = $raw->email;
                $client_id   = $this->encrypt->decode($raw->client_id);
                $client_secret   = $this->encrypt->decode($raw->client_secret);
                $reference_no  = $this->encrypt->decode($raw->reference_no);
        }
        $data_config=Array(
                        "nip"=> $nip,
                        "nama"=> $nama,
                        "nohp"=> $nohp,
                        "email"=> $email,
                        "client_id"=> $client_id,
                        "client_secret"=> $client_secret,
                        "reference_no"=> $reference_no
                 );

        $data = array(
            // 'idBilling' 	=>$idBilling,
            'response_code' => '00',
            'status' 		=> true,
            'message' 		=> 'SUKSES',
            'data' 			=> $data_config
        );
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else {
            header('Content-Type: application/json');
            echo json_encode(array(
                'message' => 'Invalid authorization token.',
                'status' => false
            ));
            return;
        }
    }


    function noreff_get(){
        $headers 	= getallheaders();
        if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer ac7f1ee943063f61517658bfc4e4672fbcd32b5a') {
            $request = $this->admin_model->get_noreff();
            foreach ($request as $raw){
                    $reference_no        = $raw->noRef+1;
            }
            $data_config=Array(
                            "reference_no"=> $reference_no,
                     );
    
            $data = array(
                'response_code' => '00',
                'status' 		=> true,
                'message' 		=> 'SUKSES',
                'data' 			=> $data_config
            );
            header('Content-Type: application/json');
            echo json_encode($data);
        }
        else {
                header('Content-Type: application/json');
                echo json_encode(array(
                    'message' => 'Invalid authorization token.',
                    'status' => false
                ));
                return;
            }
    }

    function noreff_update(){
        $request 	        = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',file_get_contents("php://input")), true);
    	$reference_no 		= $request['reference_no'];
        $headers 	        = getallheaders();
        if (isset($headers['Authorization']) && $headers['Authorization'] == 'Bearer ac7f1ee943063f61517658bfc4e4672fbcd32b5a') {
            $data = array(
                'noRef' => $reference_no
            );
            $data = $this->security->xss_clean($data);
            $result = $this->admin_model->update_noreff($data);
                if($result){
                    $response = array(
                        'response_code' => '00',
                        'status' 		=> true,
                        'message' 		=> 'SUKSES'
                    );
                }else{
                    $response = array(
                        'status' 		=> false,
                        'message' 		=> 'GAGAL'
                    );
                }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            header('Content-Type: application/json');
                echo json_encode(array(
                    'message' => 'Invalid authorization token.',
                    'status' => false
                ));
                return;
        }
    }


    
}

?>