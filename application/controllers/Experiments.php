<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'HTTP/Request2.php';
use MathPHP\Statistics\Experiment;

class Experiments extends CI_Controller {

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
		$data['title'] = "Experiment";
		$this->load->view('experiment', $data);
	}

	public function inputData()
	{
		$config['upload_path'] = './assets/externals';
		$config['allowed_types'] = '*';
		$config['max_filename'] = '255';
        $config['encrypt_name'] = false;
        $config['max_size'] = '5121';
        $config['overwrite'] = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('uploadFile')) {
            $msg = $this->upload->display_errors();
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'error',
				'msg' => $msg
			)));
			exit();
		} else {
			if (($this->upload->data('file_ext') == '.xlsx') || ($this->upload->data('file_ext') == '.xls')) {
				if ($this->upload->data('file_size') <= '5120') {
					$object = $this->upload->data();
					$namanya = "./assets/externals/{$object['file_name']}";
					$datas = [];

					if ($filen = SimpleXLSX::parse($namanya)) {
						$j = 0;
						$i = 0;
						foreach ($filen->rows() as $r => $row) {
							foreach ($row as $s => $cell) {
								$data[$i] = $cell;
								$i++;
							}
							$i=0;
							array_push($datas, $data);
						}
						
						$datas = array_values($datas);
					}

					unlink("./assets/externals/{$object['file_name']}");
					$a = $datas[1][1];
					$b = $datas[2][1];
					$c = $datas[1][2];
					$d = $datas[2][2];
					unset($datas[0]);
					$datas = array_values($datas);

					$experiment = new Experiment($datas);

					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'success',
						'a' => $a,
						'b' => $b,
						'c' => $c,
						'd' => $d,
						'datas' => $datas,
						'rr' => $experiment->riskRatio()
					)));
				} else {
					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'error',
						'msg' => 'Ukuran file yang Anda unggah terlalu besar.'
					)));
				}
			} else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'error',
					'msg' => 'Tipe file yang Anda unggah salah.'
				)));
			}
		}
	}
}