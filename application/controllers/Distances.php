<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'HTTP/Request2.php';
use MathPHP\Statistics\Distance;

class Distances extends CI_Controller {

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
		$data['title'] = 'Distance';
		$this->load->view('distance', $data);
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
							foreach ($row as $c => $cell) {
								$data[$i] = $cell;
								$i++;
							}
							$i=0;
							array_push($datas, $data);
						}
						
						$datas = array_values($datas);
					}

					// var_dump($datas);
					// die();
					// if ($filen = SimpleXLSX::parse($namanya)) {
					// 	$j = 0;
					// 	$i = 0;
					// 	foreach ($filen->rows() as $r => $row) {
					// 		foreach ($row as $c => $cell) {
					// 			$data[$i] = $cell;
					// 			if ($cell != "") {
					// 				$datass[$i][$j] = $cell;
					// 			}
					// 			$i++;
					// 		}
					// 		$i=0;
					// 		$j++;
					// 		array_push($datas, $data);
					// 	}
					// }

					unlink("./assets/externals/{$object['file_name']}");
					$x = $datas[0][0];
					$y = $datas[0][1];
					unset($datas[0]);
					$datas = array_values($datas);

					$X = [];
					$Y = [];

					for ($i = 0; $i < sizeof($datas); $i++) {
						$X[] = $datas[$i][0];
						$Y[] = $datas[$i][1];
					}
					// var_dump($X);
					// var_dump($Y);
					// die();
					// for ($i = 0; $i < sizeof($datass); $i++) {
					// 	$datass[$i] = array_slice($datass[$i], 1, sizeof($datass[$i]));
					// }
					// $datass = array_values($datass);
		
					// $stats = [];
		
					// for ($i = 0; $i < sizeof($datass); $i++) {
					// 	$stat = Descriptive::describe($datass[$i]);
					// 	array_push($stats, $stat);
					// }

					// var_dump(Distance);
					// die();

					$DB⟮X、Y⟯   = Distance::bhattacharyyaDistance([0,1],[2,3]);
					$H⟮X、Y⟯    = Distance::hellingerDistance([0,1],[2,3]);
					$D⟮X、Y⟯    = Distance::minkowski($X, $Y, $p = 2);
					$d⟮X、Y⟯    = Distance::euclidean($X, $Y);               // L² distance
					$d₁⟮X、Y⟯   = Distance::manhattan($X, $Y);               // L¹ distance, taxicab geometry, city block distance
					$JSD⟮X‖Y⟯   = Distance::jensenShannon($X, $Y);
					$d⟮X、Y⟯    = Distance::canberra($X, $Y);
					$brayCurtis = Distance::brayCurtis($X, $Y);
					$cosine    = Distance::cosine($X, $Y);
					$cos⟮α⟯     = Distance::cosineSimilarity($X, $Y);

					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'success',
						'x' => $x,
						'y' => $y,
						'datas' => $datas,
						'bd' => $DB⟮X、Y⟯,
						'hd' => $H⟮X、Y⟯,
						'md' => $D⟮X、Y⟯,
						'ed' => $d⟮X、Y⟯,
						'mhd' => $d₁⟮X、Y⟯,
						'jsd' => $JSD⟮X‖Y⟯,
						'cd' => $d⟮X、Y⟯,
						'bcd' => $brayCurtis,
						'cosine' => $cosine,
						'cos' => $cos⟮α⟯
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
