<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<pre>";
      print_r($_POST);
      echo "</pre>";
    }
?>

<!DOCTYPE html>
<html>
  <head>
      <title>Nowa faktura</title>
  </head>

  <body>

    <h1>Wystaw nową fakturę</h1>

    <form action="" method="post">
      
        <label for="client_nip">NIP klienta:</label><br>
        <input type="text" id="client_nip" name="client_nip" required><br><br>

        <label for="client_name">Nazwa klienta:</label><br>
        <input type="text" id="client_name" name="client_name" required><br><br>

        <label for="client_address">Adres klienta:</label><br>
        <input type="text" id="client_address" name="client_address" required><br><br>
        
        <label for="invoice_number">numer faktury:</label><br>
        <input type="text" id="invoice_number" name="invoice_number" required><br><br>
        
        <label for="issue_date">Data wystawienia:</label><br>
        <input type="date" id="issue_date" name="issue_date" required><br><br>
        
        <label for="sale_date">Data sprzeday:</label><br>
        <input type="date" id="sale_date" name="sale_date" required><br><br>

        <label for="due_date">Termin płatności:</label><br>
        <select id="due_date" name="due_date">
          <option value="">Wybierz termin</option>
          <option value="7">7 dni</option>
          <option value="14">14 dni</option>
          <option value="21">21 dni</option>
        </select><br/><br/>
        
        <label for="invoice_subject">Przedmiot faktury:</label><br>
        <input type="text" id="invoice_subject" name="invoice_subject" required><br><br>

        <label for="gross_price">Cena brutto:</label><br>
        <input type="text" id="gross_price" name="gross_price" required><br><br>
        
        <label for="price">Stawka VAT:</label><br>
        <input type="text" id="price" name="price" required><br><br>

        <label for="net_price">Cena netto:</label><br>
        <input type="text" id="net_price" name="net_price" required><br><br>

        <button type="submit">Dalej</button>
    </form>

  </body>
</html>