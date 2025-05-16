<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'client_nip',
        'client_name',
        'client_address',
        'invoice_number',
        'issue_date',
        'sale_date',
        'due_date',
        'invoice_subject',
        'gross_price',
        'vat_rate',
        'net_price',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'client_nip' => 'required|exact_length[10]|numeric',
        'client_name' => 'required|min_length[3]',
        'client_address' => 'required|min_length[5]',
        'invoice_number' => 'required|is_unique[invoices.invoice_number]',
        'issue_date' => 'required|valid_date',
        'sale_date' => 'required|valid_date',
        'due_date' => 'required|in_list[7,14,21]',
        'invoice_subject' => 'required|min_length[3]',
        'gross_price' => 'required|numeric|greater_than[0]',
        'vat_rate' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        'net_price' => 'required|numeric|greater_than[0]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
