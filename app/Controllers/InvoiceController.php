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

        $data['invoices'] = $model->orderBy('created_at', 'DESC')->findAll();

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
        $xml->addChild('client_nip', esc($invoice['client_nip']));
        $xml->addChild('client_name', esc($invoice['client_name']));
        $xml->addChild('client_address', esc($invoice['client_address']));
        $xml->addChild('invoice_number', esc($invoice['invoice_number']));
        $xml->addChild('issue_date', esc($invoice['issue_date']));
        $xml->addChild('sale_date', esc($invoice['sale_date']));
        $xml->addChild('due_date', esc($invoice['due_date']));
        $xml->addChild('invoice_subject', esc($invoice['invoice_subject']));
        $xml->addChild('gross_price', esc($invoice['gross_price']));
        $xml->addChild('vat_rate', esc($invoice['vat_rate']));
        $xml->addChild('net_price', esc($invoice['net_price']));

    
        return $this->response
            ->setContentType('application/xml')
            ->setBody($xml->asXML());
    }

    public function getInvoicesAsXml()
    {
        $model = new InvoiceModel();
        $invoices = $model->orderBy('created_at', 'DESC')->findAll();

        $xml = new \SimpleXMLElement('<invoices/>');

        foreach ($invoices as $invoice) {
            $invoiceNode = $xml->addChild('invoice');

            foreach ($invoice as $key => $value) {
                $invoiceNode->addChild($key, esc($value));
            }
        }
        return $this->response
            ->setContentType('application/xml')
            ->setBody($xml->asXML());
    }

}
