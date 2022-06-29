<!DOCTYPE html>
<html>
  <head>
    <title>Players & Contracts Relation</title>
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
      if (!empty($_POST['season']) && !empty($_POST['pid']) && !empty($_POST['cid'])) {
        $season = $_POST['season'];
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        $sql_statement = "INSERT INTO player_contracts(Season, PlayerID, ContractID) VALUES ('$season','$pid','$cid')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['pid']) && !empty($_POST['cid'])) {
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        $sql_statement = "DELETE FROM player_contracts WHERE PlayerID = $pid AND ContractID = $cid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Players & Contracts Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Season</th> <th>Player ID</th> <th>Contract ID</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM player_contracts";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $season = $row['Season'];
          $pid = $row['PlayerID'];
          $cid = $row['ContractID'];
          echo "<tr>" . "<th>" . $season . "</th>" . "<th>" . $pid . "</th>" . "<th>" . $cid . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="season" placeholder="Season" required="required">
        <input type="text" name="pid" placeholder="Player ID" required="required">
        <input type="text" name="cid" placeholder="Contract ID" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="pid" placeholder="Player ID" required="required">
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
        <input type="text" name="pidSearch" placeholder="Player ID">
        <input type="text" name="cidSearch" placeholder="Contract ID">
        <br>
        <button class="button">Search by season</button>
        <button class="button">Search by player ID</button>
        <button class="button">Search by contract ID</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Season</th> <th>Player ID</th> <th>Contract ID</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['seasonSearch'])) {
          $seasonSearch = $_POST['seasonSearch'];
          $sql_statement = "SELECT * FROM player_contracts WHERE Season = $seasonSearch";
        } 
        elseif (!empty($_POST['pidSearch'])) {
          $pidSearch = "\"" . $_POST['pidSearch'] . "\"";
          $sql_statement = "SELECT * FROM player_contracts WHERE PlayerID = $pidSearch";
        } 
        elseif (!empty($_POST['cidSearch'])) {
          $cidSearch = "\"" . $_POST['cidSearch'] . "\"";
          $sql_statement = "SELECT * FROM player_contracts WHERE ContractID = $cidSearch";
        } 
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['seasonSearch']) || !empty($_POST['pidSearch']) || !empty($_POST['cidSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $season = $row['Season'];
            $pid = $row['PlayerID'];
            $cid = $row['ContractID'];
            echo "<tr>" . "<th>" . $season . "</th>" . "<th>" . $pid . "</th>" . "<th>" . $cid . "</th>" . "</tr>";
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