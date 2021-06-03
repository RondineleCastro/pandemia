<?php
namespace App\Controllers;
use App\Models\AgendamentoModel;

class Agendamento extends BaseController
{
	public function index()
	{
		return view('main', ['view' => 'cadastrar-agendamento']);
	}

	public function agendar()
	{	
		$data = [];
		if ($this->request->getMethod() === 'post') {
			$model = new AgendamentoModel();
			$model->set('tipo', $this->request->getPost('tipo'));

			if($model->insert()){
				$data['msg'] = 'Agendamento realizado com sucesso';
				return redirect('agendamento/listar');
			} else {
				$data['msg'] = 'Ops... algo deu errado! :(';
				return redirect()->back()->withInput();
			}
		}
		return view('main', [
			'view' => 'cadastrar-agendamento',
			'data' => $data,
		]);
	}

	public function listar()
	{
		$cpf = \Config\Services::session()->get('cpf');
		$model = new AgendamentoModel();
		// $data = $model->where('cpf', $cpf)->orderBy('dt_in')->findAll();

		return view('main', [
			'view' => 'listar-agendamentos',
			// 'data' => $data
		]);
	}


	public function excluir($id)
	{
		$model = new AgendamentoModel();
        $data = ['status' => '1'];
        
		return $model->update($id, $data);
	}

	public function recebido($id)
	{
		$model = new AgendamentoModel();
        $data = ['status' => '10'];
        return $model->update($id, $data);
	}


	public function form()
	{
        return view('solic_form');
    }

	public function nova()
	{
        $solicModel = new SolicModel();

		$array = ['TIPO' => $this->request->getVar('tipo'), 'STATUS' => 'PENDENTE'];
		$tam = count($solicModel->where($array)->findAll());
		$date=date_create(date("Y-m-d"));
		date_add($date,date_interval_create_from_date_string(strval(floor(($tam / 4)) + 1) . " days"));
		$entrega = date_format($date,"Y-m-d");
		
        $solicModel->save([
            'NOME' => $this->request->getVar('nome'),
            'CPF'  => $this->request->getVar('cpf'),
			'DATAENTREG'  => $entrega,
			'DATACONTAM'  => $this->request->getVar('datacontam'),
			'DATAMELHORA'  => empty($this->request->getVar('datamelhora')) ? null : $this->request->getVar('datamelhora'),
			'TIPO'  => $this->request->getVar('tipo')
        ]);
        return $this->response->redirect(site_url('/'));
    }

	public function relatorios()
	{
		$solicModel = new SolicModel();

		if (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios') == 0) {
			$data['solic'] = $solicModel->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/pendentes') == 0) {
			$data['solic'] = $solicModel->where('status', 'PENDENTE')->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/concluidos') == 0) {
			$data['solic'] = $solicModel->where('STATUS', "CONCLUIDO")->orderBy('id')->findAll();
		} elseif (strcmp($_SERVER['PHP_SELF'], '/index.php/relatorios/cancelados') == 0) {
			$data['solic'] = $solicModel->where('STATUS', "CANCELADO")->orderBy('id')->findAll();
		}

		return view('relatorios', $data);
	}
}
