<? $title = "Sky Wars" ?>

<? connect() ?>
<header class="subhead">
  <div class="container">
    <h1>Sky Wars 2.0</h1>
    <p class="lead">
      Three teams spawn on separate sky islands. Various small islands separate the two teams. Find weapons 
      and armor to defeat the other team in a battle to the death. Once one team has no players left, 
      the game will end.
    </p>
    <a class="btn btn btn-large" data-toggle="modal" href="#skywars-video" >Video »</a>
    <a class="btn btn-primary btn-large" data-toggle="modal" href="#play" >Play Now »</a>
  </div>
</header>
<br />
<div class="tabbable tabs-left">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-kits" data-toggle="tab">Kits</a></li>
    <li><a href="#tab-month" data-toggle="tab">Top 100 Monthly</a></li>
    <li><a href="#tab-top" data-toggle="tab">Top 100 Overall</a></li>
    <li><a href="#tab-stats" data-toggle="tab">Game Stats</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab-kits">
      <h3>Buy Kits <small>Kits purchased will be delivered within 5 minutes</small></h3>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="form-inline fancy-kits-form pull-right" style="margin-top:15px;">
        <div class="input-prepend">
          <span class="add-on">Username: </span>
          <input type="text" name="custom" id="custom" autocomplete="off" class="span2 username" style="width: 120px;">
        </div>
        <input type="hidden" name="item_name" class="item_name" value="">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="info@mczone.co">
        <input type="hidden" name="item_number" value="1">  
        <input type="hidden" name="amount" class="price" value="0">  
        <input type="hidden" name="no_shipping" value="0">  
        <input type="hidden" name="no_note" value="1">  
        <input type="hidden" name="currency_code" value="USD">  
        <input type="hidden" name="lc" value="AU">
        <input type="hidden" name="bn" value="PP-BuyNowBF">  
        <input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/skywars/multiple.php" />
        <input type="hidden" name="return" value="http://mczone.co?notify=payment">
        <button type="submit" disabled="disabled" class="btn btn-success check item_price">Purchase Cart ($0.00)</button>
      </form>
      <table class="table ajaxify-simple">
        <thead>
          <th>Kit Name</th>
          <th>About</th>
          <th>Times Used</th>
          <th>Price</th>
          <th>Cart</th>
        </thead>
        <?
        $kitsquery = mysql_query("SELECT * FROM skywars_packages ORDER BY new,title");
        while ($row = mysql_fetch_array($kitsquery)) {
          $t = ucwords($row['title']);
          $desc = ucfirst($row['details']);
          $desc = str_replace('|','<br />&bull; ',$desc);
          $desc = '&bull; ' . $desc;
          $new = $row['new']==1 ? "background-color: #CAEECF" : "";
          $uses = mysql_num_rows(mysql_query("SELECT id FROM skywars_players WHERE kit='" . $t . "'"));
          ?>
          <tr style="<? echo $new ?>">
            <td><b><?= $t ?></b></h4>
              <td><?= $desc ?></td>
              <td><?= $uses ?></td>
              <td>$2.49</td>
              <td><input type="checkbox" class="checkbox" name="<?= strtolower($t) ?>"></td>
            </tr>
            <? } ?>
          </table>
          <hr />
        </div>
        <div class="tab-pane" id="tab-month">
         <h3>Top 100 This Month <small>Stats listed here are from this month only</small></h3>
         <table class="table table-sort">
          <thead>
            <th>#</th>
            <th></th>
            <th>Username</th>
            <th class="tip sorting_1" title="Wins x 10 + Kills x 2">Points</th>
            <th>Wins</th>
            <th>Deaths</th>
            <th>Kills</th>
            <th>K/D</th>
          </thead>
          <?
          $players = array();

          $q = mysql_query("SELECT * FROM skywars_leaderboard_month ORDER BY points DESC LIMIT 100");
          while ($stats = mysql_fetch_array($q)) { ?>
          <tr>
            <td><?= $r += 1 ?></td>
            <td><?= avatar($stats['username'],16) ?></td>
            <td><?= user($stats['username']) ?></td>
            <td><?= $stats['points'] ?></td>
            <td><?= $stats['wins'] ?></td>
            <td><?= $stats['games'] - $stats['wins'] ?></td>
            <td><?= $stats['kills'] ?></td>
            <td><?= round($stats['kills'] / ($stats['games']-$stats['wins']),2) ?></td>
          </tr>
          <? } $r = 0; ?>
        </table>
      </div>
        <div class="tab-pane" id="tab-top">
         <h3>Top 100 Players</h3>
         <table class="table table-sort">
          <thead>
            <th>#</th>
            <th></th>
            <th>Username</th>
            <th class="tip sorting_1" title="Wins x 10 + Kills x 2">Points</th>
            <th>Wins</th>
            <th>Deaths</th>
            <th>Kills</th>
            <th>K/D</th>
          </thead>
          <?
          $players = array();

          $q = mysql_query("SELECT * FROM skywars_leaderboard ORDER BY points DESC LIMIT 100");
          while ($stats = mysql_fetch_array($q)) { ?>
          <tr>
            <td><?= $r += 1 ?></td>
            <td><?= avatar($stats['username'],16) ?></td>
            <td><?= user($stats['username']) ?></td>
            <td><?= $stats['points'] ?></td>
            <td><?= $stats['wins'] ?></td>
            <td><?= $stats['games'] - $stats['wins'] ?></td>
            <td><?= $stats['kills'] ?></td>
            <td><?= round($stats['kills'] / ($stats['games']-$stats['wins']),2) ?></td>
          </tr>
          <? } ?>
        </table>
      </div>
      <div class="tab-pane" id="tab-stats">
        <h3>Recent Games <small>Updates every 3 minutes</small></h3>
        <div class="row-fluid">
          <div class="span12">
            <table class="table">
              <thead>
                <th>ID</th>
                <th>Winner</th>
                <th>Kills</th>
                <th>Players</th>
                <th>Start</th>
                <th>End</th>
                <th>Duration</th>
              </thead>
              <?
              $q = mysql_query("SELECT * FROM skywars_games WHERE winner IS NOT null ORDER BY start DESC limit 15");
              while ($row = mysql_fetch_array($q)) {
                $info = $row;
                if ($info['winner'] == null)
                  $info['winner']="NONE";
                $info['duration'] = timediff($info['start'],$info['end']);
                if ($info['duration'] > 500000) {
                  $info['duration'] = duration($info['start']);
                  $info['end'] = "";
                }
                else {
                  $info['end'] = datetime($info['end']);
                }

                $info['kills'] = mysql_num_rows(mysql_query("SELECT * FROM kills WHERE server='skywars' AND game_id=" . $row['id']));
                $info['players'] = mysql_num_rows(mysql_query("SELECT * FROM skywars_players WHERE game_id=" . $row['id']));
                ?>

                <tr>
                  <td><a href="id/<?= $row['id'] ?>"><?= $info['id'] ?></a></td>
                  <td><span class="label label-<?= $info['winner'] ?>"><?= strtoupper($info['winner']) ?></span></td>
                  <td><?= $info['kills'] ?></td>
                  <td><?= $info['players'] ?></td>
                  <td><?= datetime($info['start']) ?></td>
                  <td><?= $info['end'] ?></td>
                  <td><?= $info['duration'] ?></td>
                </tr>
                <? } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
