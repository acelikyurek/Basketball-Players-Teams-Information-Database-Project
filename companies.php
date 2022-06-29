<!DOCTYPE html>
<html>
  <head>
    <title>Companies Relation</title>
    <style>
      s1 {
        font-family: Calibri;
        font-size: 32px;
      }
      table {
        font-family: Calibri; 
        width: 1125px;
      }
      th {
        border: 5px solid #dddddd;
        text-align: center;
        padding: 5px;
        width: 250px;
      }
      tr:nth-child(n+2) {
        background-color: #dddddd;
      }
      input[type=text] {
        width: 250px;
        padding: 12px 5px;
        margin: 8px 0px;
        text-align: center;
      }
      .button 
      {
        background-color: slateblue;
        border: none;
        color: white;
        width: 262.5px;
        padding: 16px 32px;
        text-align: center;
        display: inline-block;
        font-family: Calibri;
        font-size: 16px;
        margin: 0px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <?php
    include "config.php";
    if (array_key_exists('insert', $_POST)) {
      if (!empty($_POST['cname']) && !empty($_POST['edate'])) {
        $cname = $_POST['cname'];
        $edate = $_POST['edate'];
        $sql_statement = "INSERT INTO companies(CompanyName,EstablishmentDate) VALUES ('$cname','$edate')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['cid'])) {
        $cid = $_POST['cid'];
        $sql_statement = "DELETE FROM companies WHERE CompanyID = $cid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Companies Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Company ID</th> <th>Company Name</th> <th>Date of Establishment</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM companies";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $cid = $row['CompanyID'];
          $cname = $row['CompanyName'];
          $edate = $row['EstablishmentDate'];
          echo "<tr>" . "<th>" . $cid . "</th>" . "<th>" . $cname . "</th>" . "<th>" . $edate . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="cname" placeholder="Company Name" required="required">
        <input type="text" name="edate" placeholder="Date of Establishment" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="cid" placeholder="Company ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="cidSearch" placeholder="Company ID">
        <input type="text" name="cnameSearch" placeholder="Company Name">
        <input type="text" name="edateSearch" placeholder="Date of Establishment">
        <br>
        <button class="button">Search by ID</button>
        <button class="button">Search by name</button>
        <button class="button">Search by date</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Company ID</th> <th>Company Name</th> <th>Date of Establishment</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['cidSearch'])) {
          $cidSearch = $_POST['cidSearch'];
          $sql_statement = "SELECT * FROM companies WHERE CompanyID = $cidSearch";
        } 
        elseif (!empty($_POST['cnameSearch'])) {
          $cnameSearch = "\"" . $_POST['cnameSearch'] . "\"";
          $sql_statement = "SELECT * FROM companies WHERE CompanyName = $cnameSearch";
        } 
        elseif (!empty($_POST['edateSearch'])) {
          $edateSearch = "\"" . $_POST['edateSearch'] . "\"";
          $sql_statement = "SELECT * FROM companies WHERE EstablishmentDate = $edateSearch";
        }
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['cidSearch']) || !empty($_POST['cnameSearch']) || !empty($_POST['edateSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $cid = $row['CompanyID'];
            $cname = $row['CompanyName'];
            $edate = $row['EstablishmentDate'];
            echo "<tr>" . "<th>" . $cid . "</th>" . "<th>" . $cname . "</th>" . "<th>" . $edate . "</th>" . "</tr>";
          }
        }
        ?>
      </table>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div align="center"> 
			<button class="button" onclick="window.location='main.php'">Return to Main Menu</button>
    </div>
  </body>
</html>