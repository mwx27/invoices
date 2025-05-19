# Invoices App (CodeIgniter 4)

A simple web application for creating, validating, and listing invoices, built with CodeIgniter 4.

## Features
- Add new invoices with client and invoice details
- Server-side validation for all invoice fields
- List all saved invoices in a table
- Success and error feedback for form submissions
- Data stored in a SQL database (see migration)

## Invoice Fields
- NIP klienta (client_nip)
- Nazwa klienta (client_name)
- Adres klienta (client_address)
- Numer faktury (invoice_number)
- Data wystawienia (issue_date)
- Data sprzedaży (sale_date)
- Termin płatności (due_date: 7, 14, or 21 days)
- Przedmiot faktury (invoice_subject)
- Cena brutto (gross_price)
- Stawka VAT (vat_rate)
- Cena netto (net_price)

## Getting Started

### Requirements
- PHP 8.1+
- Composer
- MySQL or compatible database

### Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/mwx27/invoices
   cd invoices
   ```
2. Install dependencies:
   ```sh
   composer install
   ```
3. Copy `.env` file and configure your database:
   ```sh
   cp env .env
   # Edit .env to set your database credentials
   ```
4. Run database migrations:
   ```sh
   php spark migrate
   ```
5. Start the development server:
   ```sh
   php spark serve
   ```
6. Visit [http://localhost:8080/invoices](http://localhost:8080/invoices) to use the app.

## Usage
- Fill out the invoice form and submit to save a new invoice.
- Validation errors will be shown if any fields are invalid.
- After successful submission, the form clears and the invoice appears in the list below.

## Project Structure
- `app/Controllers/InvoiceController.php` – Handles form display, validation, saving, and listing invoices.
- `app/Models/InvoiceModel.php` – Defines the invoice schema and validation rules.
- `app/Views/invoices.php` – The invoice form and list UI.
- `app/Database/Migrations/2025-05-14-113511_CreateInvoices.php` – Migration for the `invoices` table.

## Database Schema
The `invoices` table includes:
- id (auto-increment)
- client_nip (varchar)
- client_name (varchar)
- client_address (varchar)
- invoice_number (varchar, unique)
- issue_date (date)
- sale_date (date)
- due_date (int)
- invoice_subject (varchar)
- gross_price (decimal)
- vat_rate (decimal)
- net_price (decimal)
- created_at, updated_at (datetime)

## Development
- Routes:
  - `GET /invoices` – Show invoice form and list
  - `POST /invoices` – Submit new invoice
- Validation is handled in `InvoiceModel.php`.
- All invoices are listed below the form after submission.

## License
MIT