<!DOCTYPE html>
<html>
  <head>
    <title>Teams & Companies Relation</title>
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
      if (!empty($_POST['tid']) && !empty($_POST['cid']) && !empty($_POST['budget'])) {
        $tid = $_POST['tid'];
        $cid = $_POST['cid'];
        $budget = $_POST['budget'];
        $sql_statement = "INSERT INTO team_companies(TeamID, CompanyID, Budget) VALUES ('$tid','$cid','$budget')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['tid']) && !empty($_POST['cid'])) {
        $tid = $_POST['tid'];
        $cid = $_POST['cid'];
        $sql_statement = "DELETE FROM team_companies WHERE TeamID = $tid AND CompanyID = $cid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Teams & Companies Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Team ID</th> <th>Company ID</th> <th>Budget</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM team_companies";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $tid = $row['TeamID'];
          $cid = $row['CompanyID'];
          $budget = $row['Budget'];
          echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $cid . "</th>" . "<th>" . $budget . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tid" placeholder="Team ID" required="required">
        <input type="text" name="cid" placeholder="Company ID" required="required">
        <input type="text" name="budget" placeholder="Budget" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tid" placeholder="Team ID" required="required">
        <input type="text" name="cid" placeholder="Company ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tidSearch" placeholder="Team ID">
        <input type="text" name="cidSearch" placeholder="Company ID">
        <input type="text" name="budgetSearch" placeholder="Budget">
        <br>
        <button class="button">Search by team ID</button>
        <button class="button">Search by company ID</button>
        <button class="button">Search by budget</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Team ID</th> <th>Company ID</th> <th>Budget</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['tidSearch'])) {
          $tidSearch = $_POST['tidSearch'];
          $sql_statement = "SELECT * FROM team_companies WHERE TeamID = $tidSearch";
        } 
        elseif (!empty($_POST['cidSearch'])) {
          $cidSearch = "\"" . $_POST['cidSearch'] . "\"";
          $sql_statement = "SELECT * FROM team_companies WHERE CompanyID = $cidSearch";
        } 
        elseif (!empty($_POST['budgetSearch'])) {
          $budgetSearch = "\"" . $_POST['budgetSearch'] . "\"";
          $sql_statement = "SELECT * FROM team_companies WHERE Budget = $budgetSearch";
        } 
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['tidSearch']) || !empty($_POST['cidSearch']) || !empty($_POST['budgetSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $tid = $row['TeamID'];
            $cid = $row['CompanyID'];
            $budget = $row['Budget'];
            echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $cid . "</th>" . "<th>" . $budget . "</th>" . "</tr>";
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