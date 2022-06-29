<!DOCTYPE html>
<html>
  <head>
    <title>Players Relation</title>
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
      if (!empty($_POST['pname']) && !empty($_POST['bdate']) && !empty($_POST['pnation'])) {
        $pname = $_POST['pname'];
        $bdate = $_POST['bdate'];
        $pnation = $_POST['pnation'];
        $sql_statement = "INSERT INTO players(Name,Birthdate,Nationality) VALUES ('$pname','$bdate','$pnation')";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    if (array_key_exists('delete', $_POST)) {
      if (!empty($_POST['pid'])) {
        $pid = $_POST['pid'];
        $sql_statement = "DELETE FROM players WHERE PlayerID = $pid";
        $result = mysqli_query($db, $sql_statement);
      }
    }
    ?>
    <div align="center">
      <s1>Players Relation</s1>
      <br>
      <br>
      <table>
        <tr> <th> Player ID </th> <th> Player Name </th> <th>Player Birthdate</th> <th>Player Nationality</th> </tr>
        <?php
        include "config.php";
        $sql_statement = "SELECT * FROM players";
        $result = mysqli_query($db, $sql_statement);
        while ($row = mysqli_fetch_assoc($result)) {
          $pid = $row['PlayerID'];
          $pname = $row['Name'];
          $bdate = $row['Birthdate'];
          $nation = $row['Nationality'];
          echo "<tr>" . "<th>" . $pid . "</th>" . "<th>" . $pname . "</th>" . "<th>" . $bdate . "</th>" . "<th>" . $nation . "</th>" . "</tr>";
        }
        ?>
      </table>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="pname" placeholder="Player Name" required="required">
        <input type="text" name="bdate" placeholder="Player Birthdate" required="required">
        <input type="text" name="pnation" placeholder="Player Nationality" required="required">
        <br>
        <button class="button" name="insert">Insert</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="pid" placeholder="Player ID" required="required">
        <br>
        <button class="button" name="delete">Delete</button>
      </form>
    </div>
    <br>
    <br>
    <div align="center">
      <form method="POST">
        <input type="text" name="pidSearch" placeholder="Player ID">
        <input type="text" name="pnameSearch" placeholder="Player Name">
        <input type="text" name="bdateSearch" placeholder="Player Birthdate">
        <input type="text" name="pnationSearch" placeholder="Player Nationality">
        <br>
        <button class="button">Search by ID</button>
        <button class="button">Search by name</button>
        <button class="button">Search by birthdate</button>
        <button class="button">Search by nationality</button>
      </form>
      <br>
      <br>
      <s1>Selected Instances</s1>
      <br>
      <br>
      <table>
        <tr> <th>Player ID</th> <th>Player Name</th> <th>Player Birthdate</th> <th>Player Nationality</th> </tr>
        <?php
        include "config.php";
        if (!empty($_POST['pidSearch'])) {
          $pidSearch = $_POST['pidSearch'];
          $sql_statement = "SELECT * FROM players WHERE PlayerID = $pidSearch";
        } 
        elseif (!empty($_POST['pnameSearch'])) {
          $pnameSearch = "\"" . $_POST['pnameSearch'] . "\"";
          $sql_statement = "SELECT * FROM players WHERE Name = $pnameSearch";
        } 
        elseif (!empty($_POST['bdateSearch'])) {
          $bdateSearch = "\"" . $_POST['bdateSearch'] . "\"";
          $sql_statement = "SELECT * FROM players WHERE Birthdate = $bdateSearch";
        } 
        elseif (!empty($_POST['pnationSearch'])) {
          $pnationSearch = "\"" . $_POST['pnationSearch'] . "\"";
          $sql_statement = "SELECT * FROM players WHERE Nationality = $pnationSearch";
        }
        $result = mysqli_query($db, $sql_statement);
        if ((!empty($_POST['pidSearch']) || !empty($_POST['pnameSearch']) || !empty($_POST['bdateSearch']) || !empty($_POST['pnationSearch'])) && !is_bool($result)) {            
          while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['PlayerID'];
            $pname = $row['Name'];
            $bdate = $row['Birthdate'];
            $nation = $row['Nationality'];
            echo "<tr>" . "<th>" . $pid . "</th>" . "<th>" . $pname . "</th>" . "<th>" . $bdate . "</th>" . "<th>" . $nation . "</th>" . "</tr>";
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