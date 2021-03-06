<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
require_once 'HTTP/Request2.php';
use MathPHP\Statistics\Circular;

class Circulars extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->view('circular');
	}

	public function inputData()
	{
		$config['upload_path'] = './assets/externals';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_filename'] = '255';
        $config['encrypt_name'] = false;
        $config['max_size'] = '5120';
        $config['overwrite'] = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('uploadFile')) {
			$status = "error";
            $msg = $this->upload->display_errors();
		} else {
			$object = $this->upload->data();
			$namanya = "./assets/externals/{$object['file_name']}";
			$datas = [];

			if ($filen = SimpleXLSX::parse($namanya)) {
				$j = 0;
				$i = 0;
				foreach ($filen->rows() as $r => $row) {
					foreach ($row as $c => $cell) {
						$data[$i] = $cell;
						$i++;
					}
					$i=0;
					array_push($datas, $data);
				}
				
				$datas = array_values($datas);
			}

		}
		unlink("./assets/externals/{$object['file_name']}");
		$this->output->set_content_type('application/json')->set_output(json_encode($datas));
	}
}
