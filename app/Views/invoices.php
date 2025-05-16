
<!DOCTYPE html>
<html>
  <head>
      <title>Nowa faktura</title>
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

    <?php if (isset($success) && $success): ?>
      <p style="color:green;">✅ Faktura została zapisana do bazy!</p>
    <?php endif; ?>

    <?php if (isset($errors) && is_array($errors)): ?>
    <div style="color:red;">
        <ul>
            <?php foreach ($errors as $field => $error): ?>
                <li><strong><?= esc($field) ?>:</strong> <?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>



  </body>
</html>