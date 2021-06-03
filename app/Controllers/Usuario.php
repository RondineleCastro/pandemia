<?php
namespace App\Controllers;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
	public function index()
	{
		return view('main');
	}

	public function cadastrar()
	{
		$model = new UsuarioMOdel();

		if ($this->request->getMethod() === 'post')
	    {
	        $load = [
	        	'cpf' => $this->request->getPost('cpf'),
	            'nome' => $this->request->getPost('nome'),
	            'perfil'  => $this->request->getPost('perfil'),
	        ];
	        if ($model->save($load)){
	        	
	        	$model->login($u['cpf']);
	        }

	        return $this->response->redirect(site_url('/'));
	        // return redirect('agendamento/cadastrar');

	    }
	    return view('main',[
			'view' => 'cadastrar-usuario'
		]);
	}
}