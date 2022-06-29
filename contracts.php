<!DOCTYPE html>
<html>
  <head>
    <title>Contracts Relation</title>
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
      if (!empty($_POST['salary']) && !empty($_POST['contyear'])) {
        $salary = $_POST['salary'];
        $contyear = $_POST['contyear'];
        $sql_statement = "INSERT INTO contracts(Salary,ContractYear) VALUES ('$salary','$contyear')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['cid'])) {
        $cid = $_POST['cid'];
        $sql_statement = "DELETE FROM contracts WHERE ContractID = $cid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Contracts Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Contract ID</th> <th>Salary</th> <th>Contract Year</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM contracts";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $cid = $row['ContractID'];
          $salary = $row['Salary'];
          $contyear = $row['ContractYear'];
          echo "<tr>" . "<th>" . $cid . "</th>" . "<th>" . $salary . "</th>" . "<th>" . $contyear . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="salary" placeholder="Salary" required="required">
        <input type="text" name="contyear" placeholder="Contract Year" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="cid" placeholder="Contract ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="cidSearch" placeholder="Contract ID">
        <input type="text" name="salarySearch" placeholder="Salary">
        <input type="text" name="contyearSearch" placeholder="Contract Year">
        <br>
        <button class="button">Search by ID</button>
        <button class="button">Search by salary</button>
        <button class="button">Search by contract year</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Contract ID</th> <th>Salary</th> <th>Contract Year</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['cidSearch'])) {
          $cidSearch = $_POST['cidSearch'];
          $sql_statement = "SELECT * FROM contracts WHERE ContractID = $cidSearch";
        } 
        elseif (!empty($_POST['salarySearch'])) {
          $salarySearch = "\"" . $_POST['salarySearch'] . "\"";
          $sql_statement = "SELECT * FROM contracts WHERE Salary = $salarySearch";
        } 
        elseif (!empty($_POST['contyearSearch'])) {
          $contyearSearch = "\"" . $_POST['contyearSearch'] . "\"";
          $sql_statement = "SELECT * FROM contracts WHERE ContractYear = $contyearSearch";
        }
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['cidSearch']) || !empty($_POST['salarySearch']) || !empty($_POST['contyearSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $cid = $row['ContractID'];
            $salary = $row['Salary'];
            $contyear = $row['ContractYear'];
            echo "<tr>" . "<th>" . $cid . "</th>" . "<th>" . $salary . "</th>" . "<th>" . $contyear . "</th>" . "</tr>";
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