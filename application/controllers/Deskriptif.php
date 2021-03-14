<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'HTTP/Request2.php';
use MathPHP\Statistics\Descriptive;

class Deskriptif extends CI_Controller {

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
		$data['title'] = "Deskriptif";
		$this->load->view('deskriptif', $data);
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
            $msg = $this->upload->display_errors();
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'error',
				'msg' => $msg
			)));
		} else {
			$object = $this->upload->data();
			$namanya = "./assets/externals/{$object['file_name']}";
			$datas = [];
			$datass = [];

			if ($filen = SimpleXLSX::parse($namanya)) {
				$j = 0;
				$i = 0;
				foreach ($filen->rows() as $r => $row) {
					foreach ($row as $c => $cell) {
						$data[$i] = $cell;
						if ($cell != "") {
							$datass[$i][$j] = $cell;
						}
						$i++;
					}
					$i=0;
					$j++;
					array_push($datas, $data);
				}
			}

			unlink("./assets/externals/{$object['file_name']}");
			$heads = $datas[0];
			unset($datas[0]);
			$datas = array_values($datas);

			for ($i = 0; $i < sizeof($datass); $i++) {
				$datass[$i] = array_slice($datass[$i], 1, sizeof($datass[$i]));
			}
			$datass = array_values($datass);

			$stats = [];

			for ($i = 0; $i < sizeof($datass); $i++) {
				$stat = Descriptive::describe($datass[$i]);
				array_push($stats, $stat);
			}

			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'success',
				'heads' => $heads,
				'datas' => $datas,
				'datass' => $datass,
				'stats' => $stats
			)));
		}
	}
}