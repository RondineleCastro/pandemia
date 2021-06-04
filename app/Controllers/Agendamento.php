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


	
}
