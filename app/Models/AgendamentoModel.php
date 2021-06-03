<?php
namespace App\Models;

use CodeIgniter\Model;

class AgendamentoModel extends Model
{
	protected $table = 'agendamento';
	protected $primaryKey = 'id';
	protected $allowedFields = ['dt_in', 'dt_entrega', 'tipo', 'status', 'dt_contaminacao','dt_retorno_movimentos'];
	protected $returntype = 'object';

}