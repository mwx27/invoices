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
                'net_price',
                'vat_rate',
                'gross_price',
            ]);

            if($model->insert($postData)) {
                return redirect()->to(current_url())->with('create_success', true);
            } else {
                $data['errors'] = $model->errors();
            }
        }

        if (session()->getFlashdata('create_success')) {
            $data['create_success'] = true;
        }
        if (session()->getFlashdata('update_success')) {
            $data['update_success'] = true;
        }
        if (session()->getFlashdata('delete_success')) {
            $data['delete_success'] = true;
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
        $xml->addChild('net_price', esc($invoice['net_price']));
        $xml->addChild('vat_rate', esc($invoice['vat_rate']));
        $xml->addChild('gross_price', esc($invoice['gross_price']));

    
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


    public function updateInvoice($id) {

        helper('form');
        $model = new InvoiceModel();
        $invoice = $model->find($id);
        
        if (!$invoice) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Faktura o ID $id nie istnieje");
        }
        
        $postData = $this->request->getPost([
            'client_nip',
            'client_name',
            'client_address',
            'invoice_number',
            'issue_date',
            'sale_date',
            'due_date',
            'invoice_subject',
            'net_price',
            'vat_rate',
            'gross_price',
        ]);

        $model->setValidationRule('invoice_number', 'required|is_unique[invoices.invoice_number,id,' . $id . ']');

        if ($model->update($id, $postData)) {
            return redirect()->to(site_url('invoices'))->with('update_success', true);
        } else {
            $errors = $model->errors();
            $invoices = $model->orderBy('created_at', 'DESC')->findAll();

            return view('invoices', [
                'invoices' => $invoices,
                'errors' => $errors,
                'edit_id' => $id,
                'edit_data' => $postData + $invoice,
            ]);
        }

    }

    public function deleteInvoice($id) {

        helper('form');
        $model = new InvoiceModel();
        $invoice = $model->find($id);
        
        if (!$invoice) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Faktura o ID $id nie istnieje");
        }

        if ($model->delete($id)) {
            return redirect()->to(site_url('invoices'))->with('delete_success', true);
        } else {
            $errors = $model->errors();
            $invoices = $model->orderBy('created_at', 'DESC')->findAll();

            return view('invoices', [
                'invoices' => $invoices,
                'errors' => $errors,
            ]);
        }

    }


}
