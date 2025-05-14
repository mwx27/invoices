<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'client_nip' => ['type' => 'VARCHAR', 'constraint' => 20],
            'client_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'client_address' => ['type' => 'VARCHAR', 'constraint' => 255],
            'invoice_number' => ['type' => 'VARCHAR', 'constraint' => 50],
            'issue_date' => ['type' => 'DATE'],
            'sale_date' => ['type' => 'DATE'],
            'due_date' => ['type' => 'INT'],
            'invoice_subject' => ['type' => 'VARCHAR', 'constraint' => 255],
            'gross_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'vat_rate' => ['type' => 'DECIMAL', 'constraint' => '4,2'],
            'net_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('invoices');
    }
    
    public function down()
    {
        $this->forge->dropTable('invoices');
    }
}
