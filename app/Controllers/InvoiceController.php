<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\InvoiceModel;

class InvoiceController extends BaseController
{
    public function index()
    {
        helper('form');

        $data = [];
        $model = new InvoiceModel();
        
        if($this->request->getMethod() === 'POST') {

            $postData = $this->request->getPost([
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
            ]);

            if($model->insert($postData)) {
                return redirect()->to(current_url())->with('success', true);
            } else {
                $data['errors'] = $model->errors();
            }
        }

        if (session()->getFlashdata('success')) {
            $data['success'] = true;
        }

        $data['invoices'] = $model->findAll();

        return view('invoices', $data);
    }
}
