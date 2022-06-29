<!DOCTYPE html>
<html>
  <head>
  	<title>Basketball Database</title>
    <style>
      p1 {
        font-family: Calibri;
        font-size: 48px;
      }
      s1 {
        font-family: Calibri;
        font-size: 32px;
      }
      .button {
        background-color: slateblue;
        border: none;
        color: white;
        width: 200px;
        padding: 16px 32px;
        text-align: center;
        display: inline-block;
        font-family: Calibri;
        font-size: 16px;
        margin: 8px 8px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div align="center">
      <p1>Basketball Players & Teams Information Database</p1>
      <br>
      <br>
      <br>
      <s1>Please select the relation you want to edit:</s1>
      <br>
      <br>
      <br>
      <button class="button" onclick="window.location='players.php'">Players</button>
      <button class="button" onclick="window.location='teams.php'">Teams</button>
      <button class="button" onclick="window.location='contracts.php'">Contracts</button>
      <button class="button" onclick="window.location='companies.php'">Companies</button>
      <br>
      <button class="button" onclick="window.location='player_contracts.php'">Player & Contracts</button>
      <button class="button" onclick="window.location='team_contracts.php'">Team & Contracts</button>
      <button class="button" onclick="window.location='team_companies.php'">Team & Companies</button>
      <button class="button" onclick="window.location='statistics.php'">Player Statistics</button>
    </div>
  </body>
</html>