<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('main');
	}

	public function login()
	{
		$session = \Config\Services::session();
		$session->set([
			'user_id' => 123,
			'cpf' => '01823212325',
			'nome' => 'Raimundo',
			// 'perfil' => 'Usuário',
			'perfil' => 'Administrador',
		]);

		// $session->setFlashdata('msgFlash', 'Logon ok');
		return view('main',[
			'view' => 'cadastrar-agendamento',
		]);
	}

	public function logout()
	{
		$session = \Config\Services::session();
		$session->remove(['user_id', 'cpf', 'nome']);

		return view('main');
	}

	public function msgflash()
	{
		$msg = "mensagem flash";
		$session = \Config\Services::session();
		// $session->setFlashdata('msgFlash', $msg);
		return view('main');
	}
}
