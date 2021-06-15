<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
</head>

<body>
    <div align="center">
        <table width="100%" cellspacing="0" style="background: #f6f6f6; border: 1px solid #999999; border-radius: 30px;" cellpadding="30">
            <tr>
                <th>
                    <div align="center">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center" height="75">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table width="60%" cellspacing="0" style="border: 2px solid #999999; border-radius: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 30px 0 rgba(0, 0, 0, 0.19);" cellpadding="0">
                                        <tr>

                                            <td align="center">

                                                <table width="100%" cellspacing="0" style="background: #FFFFFF; border: 5px solid #ffffff; border-radius: 30px;font-size: 24px;color: #ffffff;" cellpadding="30">



                                                    <tr>

                                                        <td align="center" style="background: #2B5468; border-top-right-radius: 30px; border-top-left-radius: 30px; font-size: 30px;color: #ffffff;">



                                                            <img border="0" src="https://web.sicsglobal.com/aby_chalet/public/images/logo.png" width="299" height="131">
                                                        </td>

                                                    </tr>



                                                    <tr>

                                                        <td align="center" style="background: #1E4355; border-bottom-right-radius: 30px; border-bottom-left-radius: 30px; color: #ffffff;">

                                                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="color: #ffffff;">

                                                                <tr>

                                                                    <td align="center" height="70">

                                                                        <font size="6" color="#FFFF00">Hi !</font>
                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td align="left">

                                                                        <table border="0" width="100%" cellspacing="0" cellpadding="5">

                                                                            <tr>

                                                                                <td width="100%" height="50"></td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <font size="5" color="#FFFFFF">Owner Information : {{$owner_name}} </font>
                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <td width="100%" height="50"></td>

                                                                            </tr>

                                                                            <tr>

                                                                                <td width="100%">

                                                                                    <h1>

                                                                                        <font color="#FFFFFF">

                                                                                            Bank Detail </font>
                                                                                    </h1>

                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <h3>
                                                                                        <font size="5" color="#FFFFFF"> Bank Account Holder Name : </font><span lang="ar-kw" style="font-weight: 400">
                                                                                            <font size="5" color="#FFFFFF">{{$holder_name}}</font>
                                                                                        </span>
                                                                                    </h3>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <h3>
                                                                                        <font size="5" color="#FFFFFF">Bank Name :<span style="font-weight: 400">
                                                                                                <!-- {{$bank_name}} -->
                                                                                            <?php if ($bank_name == "BKM") { ?>Ahli United
                                                                                            <?php } elseif ($bank_name == "ABK") { ?>Al Ahli Bank of Kuwait
                                                                                            <?php } elseif ($bank_name == "BNP") { ?>BNP-BNP Paribas
                                                                                            <?php } elseif ($bank_name == "BBK") { ?>BOB&amp;K-Bank of Bahrain and Kuwait
                                                                                            <?php } elseif ($bank_name == "BOB") {  ?>BOBBK-Boubyan Bank
                                                                                            <?php } elseif ($bank_name == "BUR") {  ?> BURGAN-Burgan Bank of Kuwait
                                                                                            <?php } elseif ($bank_name == "COB") {  ?> CBK- Commercial Bank of Kuwait
                                                                                            <?php } elseif ($bank_name == "CBK") {  ?> Central- Central Bank of Kuwait
                                                                                            <?php } elseif ($bank_name == "CIT") {  ?> CITI-CitiBank Kuwait
                                                                                            <?php } elseif ($bank_name == "DOH") {  ?> DOHA BANK
                                                                                            <?php } elseif ($bank_name == "GBK") {  ?> GULF- Gulf Bank
                                                                                            <?php } elseif ($bank_name == "HSB") {  ?> HSBC-HSBC
                                                                                            <?php } elseif ($bank_name == "IBK") {  ?> IBK-Industrial Bank of Kuwait
                                                                                            <?php } elseif ($bank_name == "ICK") {  ?> Industrial and Commercial Bank of China Limited - Kuwait
                                                                                            <?php } elseif ($bank_name == "KFH") {  ?> KFH-Kuwait Finance House
                                                                                            <?php } elseif ($bank_name == "KIB") {  ?> KIB-Kuwait International Bank
                                                                                            <?php } elseif ($bank_name == "MSR") {  ?> Mashreq Bank
                                                                                            <?php } elseif ($bank_name == "MSQ") {  ?> Masqat Bank
                                                                                            <?php } elseif ($bank_name == "RAJ") {  ?> Masraf Al-Rajhi
                                                                                            <?php } elseif ($bank_name == "NBK") {  ?> National Bank Of Kuwait NBK
                                                                                            <?php } elseif ($bank_name == "NBA") {  ?>NBAD-National Bank of Abu Dhabi
                                                                                            <?php } elseif ($bank_name == "QNB") {  ?> QATAR NATIONAL BANK KUWAIT
                                                                                            <?php } elseif ($bank_name == "SCB") {  ?> SCB-Saving and Credit Bank
                                                                                            <?php } elseif ($bank_name == "UNB") {  ?> Union National Bank - Kuwait
                                                                                            <?php } elseif ($bank_name == "WRB") {  ?> Warba Bank
                                                                                            <?php } else {
                                                                                                    echo " ";
                                                                                                } ?>
                                                                                            </span>
                                                                                        </font>
                                                                                    </h3>

                                                                                </td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <h3>
                                                                                        <font size="5" color="#FFFFFF">IBAN Number :<span style="font-weight: 400">
                                                                                                {{$iban_num}}</span>
                                                                                        </font>
                                                                                    </h3>

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <td width="100%" height="50"></td>

                                                                            </tr>

                                                                            <tr>

                                                                                <td width="100%">

                                                                                    <h1>

                                                                                        <font color="#FFFFFF">

                                                                                            Attached Documents </font>
                                                                                    </h1>

                                                                                </td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <font size="5" color="#FFFFFF">- CIVIL ID: <a href="<?php echo $civilid; ?>">( click here )</a></font>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <font size="5" color="#FFFFFF">- Chalet ownership:<a href="<?php echo $chalet_ownership; ?>">( click here )</a></font>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <font size="5" color="#FFFFFF"> - Agreement:<a href="<?php echo $agreement; ?>">( click here )</a> </font>
                                                                                </td>

                                                                            </tr>

                                                                        </table>

                                                                    </td>

                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>

                                                </table>

                                            </td>

                                        </tr>

                                    </table>



                                </td>

                            </tr>

                            <tr>

                                <td height="50">&nbsp;

                                </td>

                            </tr>

                            <tr>

                                <td align="center">



                                    <table width="60%" cellspacing="0" style="border: 2px solid #999999; border-radius: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 30px 0 rgba(0, 0, 0, 0.19);" cellpadding="0">

                                        <tr>

                                            <td align="center">

                                                <table width="100%" cellspacing="0" style="background: #ffffff; border: 5px solid #ffffff; border-radius: 30px;font-size: 24px;color: #ffffff;" cellpadding="30">



                                                    <tr>

                                                        <td align="center">

                                                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 24px;color: #ffffff;">

                                                                <tr>

                                                                    <td align="center" height="100">

                                                                        <table cellspacing="0" cellpadding="0" width="100%">



                                                                            <tr>

                                                                                <td align="center" height="50">

                                                                                    <font size="6" style="color: black;">Thank You</font>
                                                                                </td>

                                                                            </tr>



                                                                        </table>

                                                                    </td>

                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>

                                                </table>

                                            </td>

                                        </tr>

                                    </table>



                                </td>

                            </tr>

                        </table>

                    </div>



                    <p>&nbsp;
                </th>

            </tr>



        </table>

    </div>

    </td>

    </tr>



    </table>

    </div>



</body>

</html>