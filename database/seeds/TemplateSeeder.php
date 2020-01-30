<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        factory(Template::class)->create([
            'name' => 'simple',
            'html' => '<html><body><a href="https://spatie.be">Spatie</a><br /><a href="https://flare.io">Flare</a><br /><a href="::unsubscribeUrl::">Click here to unsubscribe</a></body></html>'
        ]);

        factory(Template::class)->create([
            'name' => 'mailcoach',
            'html' => '<table width="100%" cellpadding="0" cellspacing="0" role="presentation"
       style="font-family:Inter,-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,Roboto,Helvetica,Arial,sans-serif,&quot;Apple Color Emoji&quot;,&quot;Segoe UI Emoji&quot;,&quot;Segoe UI Symbol&quot;;box-sizing:border-box;background-color:rgb(232,239,246);margin:0px;padding:0px;width:1118px;color:rgb(61,60,59);font-size:12px">
    <tbody style="box-sizing:border-box">
    <tr>
        <td align="center" style="box-sizing:border-box">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                   style="box-sizing:border-box;margin:0px;padding:0px;width:1118px">
                <tbody style="box-sizing:border-box">
                <tr>
                    <td style="box-sizing:border-box;padding:25px 0px;text-align:center;opacity:0.35"></td>
                </tr>
                <tr>
                    <td width="100%" cellpadding="0" cellspacing="0"
                        style="box-sizing:border-box;margin:0px;padding:0px;width:1118px">
                        <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation"
                               style="box-sizing:border-box;background-color:rgb(255,255,255);border-left-width:8px;border-left-style:solid;border-left-color:rgb(51,153,255);margin:0px auto;padding:0px;width:570px">
                            <tbody style="box-sizing:border-box">
                            <tr>
                                <td style="box-sizing:border-box"><img style="max-width:100%;box-sizing:border-box"
                                                                       id="m_878152091236096328192AFF271-4201-42E8-BDAF-B06818A6B914"
                                                                       src="?ui=2&amp;ik=59e8ccc154&amp;view=fimg&amp;th=16f188d0ef5f2961&amp;attid=0.1.1&amp;disp=emb&amp;attbid=ANGjdJ-akOtTjhPT_V4jAmWMe6CEwvL2CnINeyPrurP42wwOYDJrWxT0ibY8tX3Nqg2AVDbpLajNuRPltpvmsVs1wtzXKzxPnr2R0FDQIfTvCLRooctJKLzO6X-MA1M&amp;sz=s0-l75-ft&amp;ats=1576694173481&amp;rm=16f188d0ef5f2961&amp;zw&amp;atsh=1">
                                </td>
                            </tr>
                            <tr>
                                <td style="box-sizing:border-box;padding:35px"><h1
                                  style="color:rgb(61,60,59);font-size:24px;margin-top:0px;margin-bottom:2em;box-sizing:border-box">
                                    Hi everybody!</h1>
                                    <p
                                      style="line-height:1.5em;color:rgb(61,60,59);font-size:16px;margin-top:0px;box-sizing:border-box">
                                        This message is sent using <a href="https://mailcoach.app">Mailcoach</a> by <a href="https://spatie.be">Spatie</a>!</p>
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                           style="box-sizing:border-box;border-top-width:2px;border-top-style:solid;border-top-color:rgb(248,247,246);margin-top:25px;padding-top:25px">
                                        <tbody style="box-sizing:border-box">
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="box-sizing:border-box">
                        <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation"
                               style="box-sizing:border-box;margin:0px auto;padding:0px;text-align:center;width:570px">
                            <tbody style="box-sizing:border-box">
                            <tr>
                                <td align="center" style="box-sizing:border-box;padding:35px"><a
                                  href="::unsubscribeUrl::" style="color:rgb(107,106,103);box-sizing:border-box"
                                  target="_blank"
                                  data-saferedirecturl="https://www.google.com/url?hl=en-GB&amp;q=https://mailcoach.app/&amp;source=gmail&amp;ust=1576780573482000&amp;usg=AFQjCNHHb9SlzlbxiX6o9-ApTpvdU4MaQw">Unsubscribe</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>'
        ]);
    }
}
