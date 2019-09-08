<?php $url = 'https://api.gopropa.pl/v1/steam/group';
$type = 'GET';
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));
if($type == 'POST'){
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
} else {
    $param = '?token='.md5(date("Y-m-d H:i"));
    if($params){
        foreach($params as $key=>$value){
            $param .='&'.$key.'='.$value;
        }
    }
    curl_setopt($ch, CURLOPT_URL,$url.$param);
}
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close($ch);
$serwery = json_decode($server_output,true); ?>
<div class='ipsBox' style="background-color: transparent">
    <ul class="serverList">
        <?php foreach($serwery['servers'] as $server){ ?>
        <li>
            <div class="serverGame ipsResponsive_hidePhone">
                <img src="https://cdn.gopropa.pl/images/csgo.png" class="ipsResponsive_hidePhone" />
            </div>
            <div class="serverStatus">
                <?php if($server['status']) {?>
                    <span style="height:13px;width: 13px;border-radius: 50%;display:block;background-color: #3ed43e;-webkit-box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);-moz-box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);"></span>
                <?php } else { ?>
                    <span style="height:13px;width: 13px;border-radius: 50%;display:block;background-color: #d43e3e;-webkit-box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);-moz-box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);"></span>
                <?php } ?>
            </div>
            <div class="serverName">
                <?php echo $server['hostname']; ?>
            </div>
            <div class="serverAddress">
                <?php if($server['type'] == 'csgo') { ?><a data-ipsTooltip title="DOŁACZ DO SERWERA!" href="steam://connect/<?php echo $server['host']; ?>"><i class="fab fa-steam-symbol"></i> <?php echo $server['host']; ?></a><?php
                } else {?><a data-ipsTooltip title="DOŁACZ DO SERWERA!" href="ts3://<?php echo $server['host']; ?>"><i class="fab fa-steam-symbol"></i> <?php echo $server['host']; ?></a><? } ?>
            </div>
            <div class="serverMap ipsResponsive_hidePhone">
                <i class="fas fa-map-marker-alt"></i> <?php echo $server['map']; ?>
            </div>
            <div class="serverPlayers">
                <div class="number">
                    <a href='#'><i class="far fa-user"></i> <?php echo $server['currentPlayers'].'/'.$server['maxPlayers']; ?></a>
                </div>
                <div class="usersprogress">
                    <div class='ipsProgressBar ipsProgressBar_mini ipsProgressBar_fullWidth' data-ipsTooltip title='GRACZE'>
                        <?php $wartosc = round((int)$server['currentPlayers']/(int)$server['maxPlayers']*100);  ?>
                        <div data-role="progressBar" class='ipsProgressBar_progress ipsProgressBar' style="width: <?php echo $wartosc; ?>%; background: #f70000;"></div>
                    </div>
                </div>
            </div>
            <div class="serverLinks ipsResponsive_hidePhone">
                <a class="serverButton srvGt" data-ipsTooltip title='Przejdź do GameTrackera' href="http://www.gametracker.com/server_info/<?php echo $server['host']; ?>" target='_blank'><i class="fas fa-gamepad"></i></a>
                <a class="serverButton srvStats" data-ipsTooltip title='Sprawdź swoje statystyki' href='https://stats.gopropa.pl' target='_blank'><i class="fas fa-chart-bar"></i></a>
                <a class="serverButton srvShop" data-ipsTooltip title='Przejdź do sklepu' href='https://sklep.gopropa.pl' target='_blank'><i class="fas fa-shopping-cart"></i></a>
            </div>

        </li>
    <?php } ?>
    </ul>
