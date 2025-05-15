<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\InvoiceModel;

class InvoiceController extends BaseController
{
    public function index()
    {
        if($this->request->getMethod() === 'POST') {
            
            $model = new InvoiceModel();

            $data = [
                'client_nip' => $this->request->getPost('client_nip'),
                'client_name' => $this->request->getPost('client_name'),
                'client_address' => $this->request->getPost('client_address'),
                'invoice_number' => $this->request->getPost('invoice_number'),
                'issue_date' => $this->request->getPost('issue_date'),
                'sale_date' => $this->request->getPost('sale_date'),
                'due_date' => $this->request->getPost('due_date'),
                'invoice_subject' => $this->request->getPost('invoice_subject'),
                'gross_price' => $this->request->getPost('gross_price'),
                'vat_rate' => $this->request->getPost('vat_rate'),
                'net_price' => $this->request->getPost('net_price'),
            ];

            if($model->save($data)) {
                return view('invoices', ['success' => true]);
            }

        }

        return view('invoices');
    }
}
