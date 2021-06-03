<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'id';
	protected $allowedFields = ['cpf', 'nome', 'perfil','status', 'endereco'];
	protected $returntype = 'object';

	// protected $validationRules    = [
 //        'cpf' => 'required|numeric|max_length[11]|min_length[11]|is_unique[usuario.cpf]',
 //        'nome' => 'required|min_length[8]',
 //    ];

 //    protected $validationMessages = [
 //        'cpf' => [
 //            'is_unique' => 'CPF já cadastrado.',
 //        ]
 //    ];

    public function login($cpf)
    {
        $u = $this->find($model->getInsertID());
        $session = \Config\Services::session();
        $session->set([
            'user_id' => $u->id,
            'cpf' => $u->cpf,
            'nome' => $u->nome,
            'perfil' => $u->perfil,
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
}