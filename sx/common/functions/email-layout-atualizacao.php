<?php
function layout_email_atualizacao($instituicao){
   $message = "<!DOCTYPE html>
   <html style=\"padding: 0px; margin: 0px;\" lang=\"pt_br\">
      <head> 
          <meta charset=\"UTF-8\" />
           <style>
              body{margin:
                   0;padding: 0;
              }
              .media only screen and (max-width:640px){
                  table, img[class=\"partial-image\"]{
                       width:100% !important;
                       height:auto !important;
                       min-width: 200px !important; 
              }
         </style>
      </head>
   <body>
   <table style=\"border-collapse: collapse; border-spacing:
      0; min-height: 418px;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#f2f2f2\">
      <tbody>
         <tr>
            <td align=\"center\" style=\"border-collapse: collapse;
               padding-top: 30px; padding-bottom: 30px;\">
               <table cellpadding=\"5\" cellspacing=\"5\" width=\"600\" bgcolor=\"white\" style=\"border-collapse: collapse;
                  border-spacing: 0;\">
                  <tbody>
                     <tr>
                        <td style=\"border-collapse: collapse; padding: 0px;
                           text-align: center; width: 600px;\">
                           <table style=\"border-collapse: collapse; border-spacing:
                              0; box-sizing: border-box; min-height: 40px;
                              position: relative; width: 100%;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse: collapse; font-family:
                                       Arial; padding: 10px 15px; background:
                                       #fff;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse; border-spacing:
                                          0; font-family: Arial;\">
                                          <tbody>
                                             <tr>
                                                <td style=\"border-collapse: collapse;\">
                                                   <h2><a style=\"display: inline-block; text-decoration:
                                                      none; box-sizing: border-box; font-family: arial;
                                                      width: 100%; text-align: center; color:
                                                      rgb(102,102,102); font-size: 16px; cursor: text;\" target=\"_blank\"><span style=\"font-weight: normal;
                                                      color: #666;\">Atualizações de acesso</span></a>
                                                   </h2>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width:
                              100%;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse:
                                       collapse; font-family: Arial; padding: 10px
                                       15px;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse; border-spacing:
                                          0; font-family: Arial;\">
                                          <tbody>
                                             <tr>
                                                <td style=\"border-collapse: collapse;\">
                                                   <hr style=\"border-color: rgb(255,255,255);
                                                      border-style:
                                                      solid;\">
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width: 100%;
                              max-width: 600px; padding-bottom: 0px;
                              padding-left: 0px; padding-right: 0px;
                              padding-top: 0px; text-align: center;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse: collapse;
                                       font-family: Arial; padding: 0px; line-height:
                                       0px; mso-line-height-rule: exactly;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse;
                                          border-spacing: 0; font-family: Arial;\">
                                          <tbody>
                                             <tr>
                                                <td align=\"center\" style=\"border-collapse:
                                                   collapse; line-height: 0px; padding: 0;
                                                   mso-line-height-rule: exactly;\"><a target=\"_blank\" style=\"display: block; text-decoration: none;
                                                   box-sizing: border-box; font-family: arial; width:
                                                   100%;\"><img class=\"partial-image\" width=\"180\" style=\"box-sizing: border-box;
                                                   display: block; max-width: 230px; min-width:
                                                   250px;\" src=\"https://stage-grade.printercloud.com.br/sx/common/assets/grade-logo-completa-md.png\"></a></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width: 100%;
                              font-family: Arial; font-size: 25px;
                              padding-bottom: 20px; padding-top: 20px;
                              text-align: center; vertical-align:
                              middle;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse: collapse; font-family:
                                       Arial; padding: 10px 15px;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse; border-spacing:
                                          0; font-family: Arial;\">
                                          <tbody>
                                             <tr>
                                                <td style=\"border-collapse: collapse;\">
                                                      <br/>
                                                      <br/>
                                                      <a style=\"font-size: 26px;\">$instituicao</a>
                                                      <br/>
                                                      <br/><br/>
                                                      <small style='color: #4d4d4d;'>Olá, suas permissões de acesso foram atualizadas.
                                                      <br/>
                                                      </small></span></a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width:
                              100%;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse:
                                       collapse; font-family: Arial; padding: 10px
                                       15px;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse; border-spacing:
                                          0; text-align: left; font-family:
                                          Arial;\">
                                          <tbody>
                                             <tr>
                                                <td style=\"border-collapse:
                                                   collapse;\">
                                                   <div style=\"font-family: Arial;
                                                      font-size: 15px; font-weight: normal; line-height:
                                                      170%; text-align: left; color: #666; word-wrap:
                                                      break-word;\">
                                                      <div style=\"text-align:
                                                         center;\">Acesse o Grade e verifique suas atualizações<span style=\"line-height: 0;
                                                            display: none;\"></span><span style=\"line-height:
                                                            0; display:
                                                            none;\"></span>.
                                                      </div>
                                                      <div style=\"text-align:
                                                         center;\"> Acessar o Grade <br/><br/>
                                                         www.grade.printercloud.com.br<br/>
                                                   </div>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width: 100%;
                              padding-bottom: 10px; padding-top: 10px;
                              text-align: center;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse: collapse; font-family:
                                       Arial; padding: 10px 15px;\">
                                       <div style=\"font-family: Arial; text-align:
                                          center;\">
                                          <table style=\"border-collapse:
                                             collapse; border-spacing: 0; background-color:
                                             rgb(64,190,255); border-radius: 10px; color:
                                             rgb(255,255,255); display: inline-block;
                                             font-family: Arial; font-size: 15px; font-weight:
                                             bold; text-align: center;\">
                                             <tbody style=\"display:
                                                inline-block;\">
                                                <tr style=\"display:
                                                   inline-block;\">
                                                  
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width:
                              100%;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse:
                                       collapse; font-family: Arial; padding: 10px
                                       15px;\">
                                       <table width=\"100%\" style=\"border-collapse: collapse; border-spacing:
                                          0; font-family: Arial;\">
                                          <tbody>
                                             <tr>
                                                <td style=\"border-collapse: collapse;\">
                                                   <hr style=\"border-color: rgb(255,255,255);
                                                      border-style:
                                                      solid;\">
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style=\"border-collapse: collapse;
                              border-spacing: 0; box-sizing: border-box;
                              min-height: 40px; position: relative; width: 100%;
                              padding: 30px 0px; text-align: center;\">
                              <tbody>
                                 <tr>
                                    <td style=\"border-collapse: collapse;
                                       font-family: Arial; padding: 10px 15px;\">
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <div style=\"font-family: Arial;
                                                      font-size: 15px; font-weight: normal; line-height:
                                                      170%; text-align: center; color: #666; word-wrap:
                                                      break-word;\">
                             <font size=\"2\"> Copyright© 2020. Todos os direitos reservados para Printer do Brasil.</font>
                             <br />
                             <font size=\"1\"> Suporte tecnológico
                                 <a href=\"https://fluxo.pro\" target=\"_blank\" target=\"_top\" style=\"text-decoration:none;color: #666\">FLUXO Business Automation</a> em Curitiba - Brasil</font>
                         
                         </div>
                     </td>
                 </tr>
                 </tbody>
             </table>
         </td>
      </tr>
   </tbody>
</table>
</body>
</html>";
return $message;
}