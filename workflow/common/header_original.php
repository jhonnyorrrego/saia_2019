<div id="header">
        <table style="height: 52px;" width="100%" border="0" cellpadding="0" cellspacing="0" >
            <tr>
                <td width="10">&nbsp;</td>
                <!--<td style="/*border: 1px solid green;*/" width="100" valign="middle"><a href="../index.php"><img src="../editor/assets/images/logo_webapp.jpg" border="0" width="128" height="38" alt="Diagramo editor logo"/></a></td>
                <td valign="top"><span style="font-size: 10px;">v<?//=VERSION?></span></td>-->
                <?if(SERVICE){?>
                <td width="70">
                    <a href="../download.php"><img src="./assets/images/download_medium.gif" border="0"/></a>
                </td>
                <td width="20" align="center">
                    <img style="vertical-align:middle;" src="http://<?=WEBADDRESS?>/editor/assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                </td>
                <?}?>
                <?if(is_object($loggedUser)){?>
                    <!--<td width="70" align="center">
                        <a style="text-decoration: none;" href="./settings.php"><img style="vertical-align:middle; margin-right: 5px;" src="../editor/assets/images/icon_settings.gif" border="0" width="22" height="21"/><span class="menuText"><span>Opciones</span></span></a>
                    </td>-->
                    <!--<td width="20" align="center">
                        <img style="vertical-align:middle;" src="../editor/assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <td width="170" align="center">
                        <a style="text-decoration: none;" href="./common/controller.php?action=logoutExe"><img style="vertical-align:middle; margin-right: 5px;" src="../editor/assets/images/icon_logout.gif" border="0" width="16" height="16"/><span class="menuText">Cerrar sesion(<?=$loggedUser->email?>)</span></a>
                    </td>-->
                    <td width="10">&nbsp;</td>
                <?}else{?>
                    <td>&nbsp;</td>
                <?}?>
            </tr>
        </table>
    </div>