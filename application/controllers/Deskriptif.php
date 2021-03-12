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
			$status = "error";
            $msg = $this->upload->display_errors();
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

		}
		unlink("./assets/externals/{$object['file_name']}");
		$heads = $datas[0];
		unset($datas[0]);
        $datas = array_values($datas);

		$datass[0] = array_slice($datass[0], 1, sizeof($datass[0]));
		$datass[1] = array_slice($datass[1], 1, sizeof($datass[1]));
		$datass[2] = array_slice($datass[2], 1, sizeof($datass[2]));
		$datass[3] = array_slice($datass[3], 1, sizeof($datass[3]));
		$datass = array_values($datass);

		$stats = [];
		$stat = Descriptive::describe($datass[0]);
		array_push($stats, $stat);
		$stat = Descriptive::describe($datass[1]);
		array_push($stats, $stat);
		$stat = Descriptive::describe($datass[2]);
		array_push($stats, $stat);
		$stat = Descriptive::describe($datass[3]);
		array_push($stats, $stat);

		$this->output->set_content_type('application/json')->set_output(json_encode(array(
			'heads' => $heads,
			'datas' => $datas,
			'datass' => $datass,
			'stats' => $stats
		)));
	}
}