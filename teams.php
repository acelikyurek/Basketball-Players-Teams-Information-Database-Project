<!DOCTYPE html>
<html>
  <head>
    <title>Teams Relation</title>
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
      if (!empty($_POST['lname']) && !empty($_POST['tname'])) {
        $lname = $_POST['lname'];
        $tname = $_POST['tname'];
        $sql_statement = "INSERT INTO teams(League,TeamName) VALUES ('$lname','$tname')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['tid'])) {
        $tid = $_POST['tid'];
        $sql_statement = "DELETE FROM teams WHERE TeamID = $tid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Teams Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th>Team ID</th> <th>League</th> <th>Team Name</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM teams";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $tid = $row['TeamID'];
          $lname = $row['League'];
          $tname = $row['TeamName'];
          echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $lname . "</th>" . "<th>" . $tname . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="lname" placeholder="League" required="required">
        <input type="text" name="tname" placeholder="Team Name" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tid" placeholder="Team ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="tidSearch" placeholder="Team ID">
        <input type="text" name="lnameSearch" placeholder="League">
        <input type="text" name="tnameSearch" placeholder="Team Name">
        <br>
        <button class="button">Search by ID</button>
        <button class="button">Search by league</button>
        <button class="button">Search by name</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Team ID</th> <th>League</th> <th>Team Name</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['tidSearch'])) {
          $tidSearch = $_POST['tidSearch'];
          $sql_statement = "SELECT * FROM teams WHERE TeamID = $tidSearch";
        } 
        elseif (!empty($_POST['lnameSearch'])) {
          $lnameSearch = "\"" . $_POST['lnameSearch'] . "\"";
          $sql_statement = "SELECT * FROM teams WHERE League = $lnameSearch";
        } 
        elseif (!empty($_POST['tnameSearch'])) {
          $tnameSearch = "\"" . $_POST['tnameSearch'] . "\"";
          $sql_statement = "SELECT * FROM teams WHERE TeamName = $tnameSearch";
        }
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['tidSearch']) || !empty($_POST['lnameSearch']) || !empty($_POST['tnameSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $tid = $row['TeamID'];
            $lname = $row['League'];
            $tname = $row['TeamName'];
            echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $lname . "</th>" . "<th>" . $tname . "</th>" . "</tr>";
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