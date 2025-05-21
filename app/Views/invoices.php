<!DOCTYPE html>
<html>
  <head>
      <title>Nowa faktura</title>
      <style>
        table {
          border-collapse: collapse;
          border: 1px solid black;
        }
        th, td {
          border: 1px solid black;
          padding: 5px;
        }
        td input {
          width: 100%;
          box-sizing: border-box;
        }
      </style>
  </head>

  <body>

    <h1>Wystaw nową fakturę</h1>
    
    <form action="<?= current_url(); ?>" method="post">
  
      <label for="client_nip">NIP klienta:</label><br>
      <input type="text" id="client_nip" name="client_nip" value="<?= set_value('client_nip') ?>"><br><br>

      <label for="client_name">Nazwa klienta:</label><br>
      <input type="text" id="client_name" name="client_name" value="<?= set_value('client_name') ?>"><br><br>

      <label for="client_address">Adres klienta:</label><br>
      <input type="text" id="client_address" name="client_address" value="<?= set_value('client_address') ?>"><br><br>
      
      <label for="invoice_number">Numer faktury:</label><br>
      <input type="text" id="invoice_number" name="invoice_number" value="<?= set_value('invoice_number') ?>"><br><br>
      
      <label for="issue_date">Data wystawienia:</label><br>
      <input type="date" id="issue_date" name="issue_date" value="<?= set_value('issue_date') ?>"><br><br>
      
      <label for="sale_date">Data sprzedaży:</label><br>
      <input type="date" id="sale_date" name="sale_date" value="<?= set_value('sale_date') ?>"><br><br>

      <label for="due_date">Termin płatności:</label><br>
      <select id="due_date" name="due_date">
        <option value="">Wybierz termin</option>
        <option value="7" <?= set_select('due_date', '7') ?>>7 dni</option>
        <option value="14" <?= set_select('due_date', '14') ?>>14 dni</option>
        <option value="21" <?= set_select('due_date', '21') ?>>21 dni</option>
      </select><br/><br/>
      
      <label for="invoice_subject">Przedmiot faktury:</label><br>
      <input type="text" id="invoice_subject" name="invoice_subject" value="<?= set_value('invoice_subject') ?>"><br><br>

      <label for="gross_price">Cena brutto:</label><br>
      <input type="text" id="gross_price" name="gross_price" value="<?= set_value('gross_price') ?>"><br><br>
      
      <label for="vat_rate">Stawka VAT:</label><br>
      <input type="text" id="vat_rate" name="vat_rate" value="<?= set_value('vat_rate') ?>"><br><br>

      <label for="net_price">Cena netto:</label><br>
      <input type="text" id="net_price" name="net_price" value="<?= set_value('net_price') ?>"><br><br>

      <button type="submit">Dalej</button>
    </form>

    <?php if (isset($create_success) && $create_success): ?>
      <p style="color:green;">✅ Faktura została zapisana do bazy!</p>
    <?php endif; ?>

    <?php if (!isset($edit_id) && isset($errors) && is_array($errors)): ?>
      <div style="color:red;">
          <ul>
              <?php foreach ($errors as $field => $error): ?>
                  <li><strong><?= esc($field) ?>:</strong> <?= esc($error) ?></li>
              <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>


    <?php if (!empty($invoices)): ?>
      <h2>Wystawione faktury:</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nazwa klienta</th>
            <th>Adres klienta</th>
            <th>NIP</th>
            <th>Numer faktury</th>
            <th>Data wystawienia</th>
            <th>Data sprzedaży</th>
            <th>Termin płatności</th>
            <th>Przedmiot</th>
            <th>Netto</th>
            <th>VAT</th>
            <th>Brutto</th>
            <th>XML</th>
            <th style="min-width: 50px">Akcje</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($invoices as $invoice): ?>
            <tr>
              <?php if ((isset($edit_id) && $edit_id == $invoice['id']) || (isset($_GET['edit']) && $_GET['edit'] == $invoice['id'])): ?>
                <form action="<?= site_url('invoices/update/' . $invoice['id']) ?>" method="post">
                  <td><?= esc($invoice['id']) ?></td>
                  <td><input type="text" name="client_name" value="<?= esc($edit_data['client_name'] ?? $invoice['client_name']) ?>"></td>
                  <td><input type="text" name="client_address" value="<?= esc($edit_data['client_address'] ?? $invoice['client_address']) ?>"></td>
                  <td><input type="text" name="client_nip" value="<?= esc($edit_data['client_nip'] ?? $invoice['client_nip']) ?>"></td>
                  <td><input type="text" name="invoice_number" value="<?= esc($edit_data['invoice_number'] ?? $invoice['invoice_number']) ?>"></td>
                  <td><input type="date" name="issue_date" value="<?= esc($edit_data['issue_date'] ?? $invoice['issue_date']) ?>"></td>
                  <td><input type="date" name="sale_date" value="<?= esc($edit_data['sale_date'] ?? $invoice['sale_date']) ?>"></td>
                  <td><input type="text" name="due_date" value="<?= esc($edit_data['due_date'] ?? $invoice['due_date']) ?>"></td>
                  <td><input type="text" name="invoice_subject" value="<?= esc($edit_data['invoice_subject'] ?? $invoice['invoice_subject']) ?>"></td>
                  <td><input type="text" name="net_price" value="<?= esc($edit_data['net_price'] ?? $invoice['net_price']) ?>"></td>
                  <td><input type="text" name="vat_rate" value="<?= esc($edit_data['vat_rate'] ?? $invoice['vat_rate']) ?>"></td>
                  <td><input type="text" name="gross_price" value="<?= esc($edit_data['gross_price'] ?? $invoice['gross_price']) ?>"></td>
                  <td>
                    <a href="<?= site_url('invoices/xml/' . $invoice['id']) ?>" target="_blank">Zobacz XML</a>
                  </td>
                  <td>
                    <input type="submit" id="save <?= $invoice['id'] ?>" style="display: none;" />
                    <label for="save <?= $invoice['id'] ?>" title="zapisz zmiany" style="cursor: pointer; ">💾</label>
                    <a href="<?= site_url('invoices') ?>" style="text-decoration: none;" title="odrzuć zmiany">✖️</a>
                  </td>
                </form>
              <?php else: ?>
                <td><?= esc($invoice['id']) ?></td>
                <td><?= esc($invoice['client_name']) ?></td>
                <td><?= esc($invoice['client_address']) ?></td>
                <td><?= esc($invoice['client_nip']) ?></td>
                <td><?= esc($invoice['invoice_number']) ?></td>
                <td><?= esc($invoice['issue_date']) ?></td>
                <td><?= esc($invoice['sale_date']) ?></td>
                <td><?= esc($invoice['due_date']) ?> dni</td>
                <td><?= esc($invoice['invoice_subject']) ?></td>
                <td><?= esc($invoice['net_price']) ?> zł</td>
                <td><?= esc($invoice['vat_rate']) ?> zł</td>
                <td><?= esc($invoice['gross_price']) ?> zł</td>
                <td>
                  <a href="<?= site_url('invoices/xml/' . $invoice['id']) ?>" target="_blank">Zobacz XML</a>
                </td>
                <td>
                  <div style="display:flex; align-items: center; justify-content: space-between;">
                    <a href="?edit=<?= $invoice['id'] ?>" style="text-decoration: none;" title="edytuj">✏️</a>
                    <form action="<?= site_url('invoices/delete/' . $invoice['id']) ?>" method="post" onsubmit="return confirm('Czy na pewno chcesz usunąć tę fakturę?');">
                      <button type="submit" style="display: none;" id=<?= "button-" . $invoice['id']?>></button>
                      <label for=<?= "button-" . $invoice['id']?> style="cursor: pointer;" title="usuń">🗑️</label>
                    </form>
                  </div>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php if (isset($edit_id) && isset($errors)): ?>
        <div style="color:red;">
          <ul>
            <?php foreach ($errors as $field => $error): ?>
              <li><strong><?= esc($field) ?>:</strong> <?= esc($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <?php if (isset($delete_success) && $delete_success): ?>
        <p style="color:green;">Faktura została usunięta z bazy ✅</p>
      <?php endif; ?>
      <?php if (isset($update_success) && $update_success): ?>
        <p style="color:green;">✅ Faktura została zaktualizowana w bazie!</p>
      <?php endif; ?>
      <h3><a href="<?= site_url('invoices/xml/') ?>" target="_blank">Zobacz wszystkie faktury w XML</a></h3>
    <?php endif; ?>

  </body>
</html>