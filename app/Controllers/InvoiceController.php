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

    public function getInvoiceAsXml($id)
    {
        $model = new \App\Models\InvoiceModel();
        $invoice = $model->find($id);
    
        if (!$invoice) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Faktura o ID $id nie istnieje.");
        }
    
        $xml = new \SimpleXMLElement('<invoice/>');
        foreach ($invoice as $key => $value) {
            $xml->addChild($key, htmlspecialchars($value));
        }
    
        return $this->response
            ->setContentType('application/xml')
            ->setBody($xml->asXML());
    }

}
