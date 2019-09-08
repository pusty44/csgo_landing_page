<div class='ipsBox' style="background-color: transparent">
    {{if $orientation == 'horizontal'}}

    <ul class="serverList">
        {{foreach $servers as $server}}
        <li>
            <div class="serverGame ipsResponsive_hidePhone">
                <img src="https://cdn.gopropa.pl/images/{$server['type']}.png" class="ipsResponsive_hidePhone" />
            </div>
            <div class="serverStatus">
                {{if $server['online']}}
                <span style="height:13px;width: 13px;border-radius: 50%;display:block;background-color: #3ed43e;-webkit-box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);-moz-box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);box-shadow: 0px 0px 48px 0px rgba(0,176,0,1);"></span>
                {{else}}
                <span style="height:13px;width: 13px;border-radius: 50%;display:block;background-color: #d43e3e;-webkit-box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);-moz-box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);box-shadow: 0px 0px 48px 0px rgba(176,0,0,1);"></span>
                {{endif}}
            </div>
            <div class="serverName">
                {truncate="$server['hostname']" length="50" raw="true"}
            </div>
            <div class="serverAddress">
                <a data-ipsTooltip title='To jest adres ip serwera! Kliknij i połącz!' href='{$server['host']}'><i class="fab fa-steam-symbol"></i>&nbsp;{$server['host']} {{if $server['port'] != 27015 && $server['port'] != 9987}} :{{$server['post']}} {{endif}}</a>
            </div>
            <div class="serverMap ipsResponsive_hidePhone">
                <i class="fas fa-map-marker-alt"></i>&nbsp;{truncate="$server['map']" length="15"}
            </div>
            <div class="serverPlayers">
                <div class="number">
                    <i class="far fa-user"></i>&nbsp;{$server['currentPlayers']} / {$server['maxPlayers']}
                </div>
                <div class="usersprogress">
                    <div class='ipsProgressBar ipsProgressBar_mini ipsProgressBar_fullWidth' >
                        <div data-role="progressBar" class='ipsProgressBar_progress ipsProgressBar' style='width: {$server['percent']}%; background: {$server['percent_color']}'></div>
                </div>
            </div>
</div>
<div class="serverLinks ipsResponsive_hidePhone">
    <div class="links">
        <div class="serverButton srvRecord" data-ipsTooltip title='Najwięcej graczy: {$stats['playersMax']} ( {$stat['playersDate} )'>
        <i class="fas fa-chart-line"></i>
    </div>
    <a class="serverButton srvGt" data-ipsTooltip title='Przejdź do GameTrackera' href='http://www.gametracker.com/server_info/{$server['host']}:{$server['port']}' target='_blank'><i class="fas fa-gamepad"></i></a>
    <a class="serverButton srvStats" data-ipsTooltip title='Sprawdź swoje statystyki' href='https://stats.gopropa.pl' target='_blank'><i class="fas fa-chart-bar"></i></a>
    <a class="serverButton srvShop" data-ipsTooltip title='Przejdź do sklepu' href='https://sklep.gopropa.pl' target='_blank'><i class="fas fa-shopping-cart"></i></a>
</div>
</div>

</li>
{{endforeach}}
</ul>

{{if settings.gs_sl_public_stats}}
<ul class="superStats">
    <li>
        <div class="value">
            {$allServerStats['game_servers'] + $allServerStats['voice_servers']}
        </div>
        <div class="key">
            WSZYSTKICH SERWERÓW
        </div>
    </li>
    <li>
        <div class="value">
            {$allServerStats['fill_servers']}
        </div>
        <div class="key">
            ZAPEŁNIENIE SERWERÓW
        </div>
    </li>
    <li>
        <div class="value">
            {$allServerStats['players_num']}/{$allServerStats['players_max']}
        </div>
        <div class="key">
            WSZYSTKICH GRACZY
        </div>
    </li>
    <li>
        <div class="value">
            {$allServerStats['players_most']}
        </div>
        <div class="key">
            NAJWIĘCEJ GRACZY
        </div>
    </li>
    <li>
        <div class="value">
            {$allServerStats['last_update']|raw}
        </div>
        <div class="key">
            AKTUALIZACJA
        </div>
    </li>
</ul>
{{endif}}
{{else}}
<h3 class='ipsWidget_title ipsType_reset'>
    <i class='fa fa-list'></i>
    {$tableHeader|raw}
</h3>
<div class='ipsWidget_inner ipsType_small'>
    {{foreach $data as $server}}
    <div class='ipsClearfix{{if $server['new_server']}} newServer{{endif}}{{if !$server['online']}} ipsType_negative{{endif}}'>
    <div class='ipsPos_left ipsType_medium'>
        <img src='{$server['type_icon']}' alt='{$server['type']}' data-ipsTooltip title='{$server['type_name']}'>
        <strong {{if $server['desc']}}data-ipsTooltip title='{lang="more_information"}...' data-ipsDialog data-ipsDialog-title='{lang="cdesc"}' data-ipsDialog-content='#serverInfo{$server['id']}'{{endif}}>{truncate="$server['shortname'] ?: $server['hostname']" length="23" raw="true"}</strong>
    </div>
    <div class='ipsPos_right'><span class='ipsBadge ipsBadge_{{if $server['online']}}positive'>{lang="online"}{{else}}negative'>{lang="offline"}{{endif}}</span></div>
    <div class='ipsClear'></div>
    <div class='ipsPos_left'><strong>{lang="ip_address"}:</strong> <a data-ipsTooltip title='{lang="gs_sl_join"}' href='{$server['link']}'>{$server['ip']}</a></div>
    <div class='ipsClear'></div>
    <div class='ipsPos_left'><strong>{lang="gs_sl_map_name"}:</strong> <a href='#' id='mapInfoMenu{$server['id']}' data-ipsMenu{{if $server['next_map']}} data-ipsTooltip title='{lang="gs_sl_next_map"} {$server['next_map']}'{{endif}}>{truncate="$server['map']" length="15"}</a></div>
    <div class='ipsPos_right'>
        <span class='ipsBadge ipsBadge_most ipsBadge_negative ipsBadge_icon fa' data-ipsTooltip title='{lang="gs_sl_players_most"}: {$server['players_most']['players']} ( {$server['players_most']['date']} )'></span>
        {{if $server['gt']}}
        <a class='ipsBadge ipsBadge_gt ipsBadge_icon fa' data-ipsTooltip title='{lang="gs_sl_gt"}' href='http://www.gametracker.com/server_info/{$server['gt_ip']}' target='_blank'></a>
        {{endif}}
        {{if $server['tv_link']}}
        <a class='ipsBadge ipsBadge_tv ipsBadge_new ipsBadge_icon fa' data-ipsTooltip title='{lang="gs_sl_tv"}' href='{$server['tv_link']}' target='_blank'></a>
        {{endif}}
        {{if $server['stats_link']}}
        <a class='ipsBadge ipsBadge_stats ipsBadge_style2 ipsBadge_icon fa' data-ipsTooltip title='{lang="gs_sl_stats"}' href='{$server['stats_link']}' target='_blank'></a>
        {{endif}}
        {{if $server['shop_link']}}
        <a class='ipsBadge ipsBadge_shop ipsBadge_intermediary ipsBadge_icon fa' data-ipsTooltip title='{lang="gs_sl_shop"}' href='{$server['shop_link']}' target='_blank'></a>
        {{endif}}
    </div>
    <div class='ipsProgressBar ipsProgressBar_mini ipsProgressBar_fullWidth'>
        <div data-role="progressBar" class='ipsProgressBar_progress ipsProgressBar' style='width: {$server['percent']}%; background: {$server['percent_color']}'>
        <div class='playersCount'>
            {$server['players_num']} / {$server['players_max']}
        </div>
    </div>
</div>
</div>
<hr class='ipsHr'>
{{endforeach}}
</div>
{{endif}}
</div>

{{foreach $data as $server}}
{{if $server['desc']}}
<div class='ipsHide' id='serverInfo{$server['id']}'>
<div class='ipsType_center'>{lang="gs_sl_descContentLang{$server['id']}"}</div>
</div>
{{endif}}

<div class='playersInfo ipsHide' id='playersInfo{$server['id']}'>
{{if !$server['players_num']}}
<div class='ipsType_center ipsType_bold' style='margin: 5px;'>{lang="gs_sl_no_players"}</div>
{{else}}
<table class='ipsTable ipsTable_responsive'>
    <thead>
    <tr>
        <th>#</th>
        <th>{lang="gs_sl_player_name"}</th>
        <th data-score-type='{$server['type']}'>{lang="gs_sl_player_score"}</th>
        <th data-time-type='{$server['type']}'>{lang="gs_sl_player_time"}</th>
    </tr>
    </thead>
    <tbody>
    {{foreach $server['players'] as $key => $player}}
    <tr>
        <td><i class='fa fa-user'></i></td>
        <td>{$player['gq_name']|raw}</td>
        <td data-score-type='{$server['type']}'>{lang="gs_sl_score" pluralize="$player['gq_kills'] ?: $player['gq_score']"}</td>
        <td data-time-type='{$server['type']}'>{$player['gq_time']}</td>
    </tr>
    {{endforeach}}
    </tbody>
</table>
{{endif}}
</div>

<div id='mapInfoMenu{$server['id']}_menu' class='ipsHide'>
<img src='{$server['map_image']}' alt='{$server['map']}'>
</div>
{{endforeach}}