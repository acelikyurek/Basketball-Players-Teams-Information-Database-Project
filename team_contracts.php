<!DOCTYPE html>
<html>
  <head>
    <title>Teams & Contracts Relation</title>
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
      if (!empty($_POST['season']) && !empty($_POST['tid']) && !empty($_POST['cid'])) {
        $season = $_POST['season'];
        $tid = $_POST['tid'];
        $cid = $_POST['cid'];
        $sql_statement = "INSERT INTO team_contracts(Season, TeamID, ContractID) VALUES ('$season','$tid','$cid')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['tid']) && !empty($_POST['cid'])) {
        $tid = $_POST['tid'];
        $cid = $_POST['cid'];
        $sql_statement = "DELETE FROM team_contracts WHERE TeamID = $tid AND ContractID = $cid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Teams & Contracts Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Season</th> <th>Team ID</th> <th>Contract ID</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM team_contracts";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $season = $row['Season'];
          $tid = $row['TeamID'];
          $cid = $row['ContractID'];
          echo "<tr>" . "<th>" . $season . "</th>" . "<th>" . $tid . "</th>" . "<th>" . $cid . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="season" placeholder="Season" required="required">
        <input type="text" name="tid" placeholder="Team ID" required="required">
        <input type="text" name="cid" placeholder="Contract ID" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tid" placeholder="Team ID" required="required">
        <input type="text" name="cid" placeholder="Contract ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="seasonSearch" placeholder="Season">
        <input type="text" name="tidSearch" placeholder="Team ID">
        <input type="text" name="cidSearch" placeholder="Contract ID">
        <br>
        <button class="button">Search by season</button>
        <button class="button">Search by team ID</button>
        <button class="button">Search by contract ID</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Season</th> <th>Team ID</th> <th>Contract ID</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['seasonSearch'])) {
          $seasonSearch = $_POST['seasonSearch'];
          $sql_statement = "SELECT * FROM team_contracts WHERE Season = $seasonSearch";
        } 
        elseif (!empty($_POST['tidSearch'])) {
          $tidSearch = "\"" . $_POST['tidSearch'] . "\"";
          $sql_statement = "SELECT * FROM team_contracts WHERE TeamID = $tidSearch";
        } 
        elseif (!empty($_POST['cidSearch'])) {
          $cidSearch = "\"" . $_POST['cidSearch'] . "\"";
          $sql_statement = "SELECT * FROM team_contracts WHERE ContractID = $cidSearch";
        } 
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['seasonSearch']) || !empty($_POST['tidSearch']) || !empty($_POST['cidSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $season = $row['Season'];
            $tid = $row['TeamID'];
            $cid = $row['ContractID'];
            echo "<tr>" . "<th>" . $season . "</th>" . "<th>" . $tid . "</th>" . "<th>" . $cid . "</th>" . "</tr>";
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